window.addEvent('load', function(){
    var zoom = new OpenLayers.Control.ZoomPanel();
    var photoBounds = new OpenLayers.Bounds();
    var bounded = false;
    zoom.controls[1].trigger = function(){
    	if (photoBounds) map.zoomToExtent(photoBounds);
    };
	
    var map = new OpenLayers.Map ('map', {
        controls: [
            new OpenLayers.Control.Navigation(),
            new OpenLayers.Control.Attribution(),
            zoom
        ],
        theme: null,
        maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
        maxResolution: 156543.0399,
        numZoomLevels: 19,
        units: 'm',
        projection: new OpenLayers.Projection('EPSG:900913'),
        displayProjection: new OpenLayers.Projection('EPSG:4326')
    });

    var osm = new OpenLayers.Layer.OSM.Mapnik('OSM', {
    	buffer: 2
    });
    osm.url = ([
        'http://a.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
        'http://b.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
        'http://c.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/'
    ]);
    map.addLayer(osm);
    map.setCenter(new OpenLayers.LonLat(-118.489609, 33.757989).transform(new OpenLayers.Projection('EPSG:4326'), map.getProjectionObject()), 10);
    
    var loading = new Element('div', {
    	'id': 'loading-overlay',
    	'style': 'position: absolute; margin: 0; padding: 0; top: 0; right: 0; bottom: 0; left: 0; z-index: 65554'
    }).adopt(
    	new Element('h3', {
    		'style': 'position: absolute; top: 50%; left: 46%; color: #fff; z-index: 65553',
    		'html': 'Loading'
    	}),
    	new Element('div', {
	    	'style': 'width: 100%; height: 100%; background-color: #000;'
	    }).setOpacity(0.7)
    );
    
    var photos = new OpenLayers.Layer.Vector('Photos', {
	    strategies: [
	        new OpenLayers.Strategy.Fixed({ preload: true }), //should use BBox
	        new OpenLayers.Strategy.Cluster()
	    ],
	    protocol: new OpenLayers.Protocol.HTTP({
	        url: HABWatch.Flickr.URL,
	        format: new OpenLayers.Format.GeoJSON({
                'internalProjection': new OpenLayers.Projection('EPSG:900913'),
                'externalProjection': new OpenLayers.Projection('EPSG:4326')
            })
	    }),
	    styleMap: new OpenLayers.StyleMap({
	        'default': new OpenLayers.Style({
	            pointRadius: '${radius}',
	            fillColor: '#67B1E6',
	            fillOpacity: 0.8,
	            strokeColor: '#004E85',
	            strokeWidth: 2,
	            strokeOpacity: 0.8
	        }, {
	            context: {
	                radius: function(feature) {
	                    return Math.pow(2, feature.attributes.count/1.5).limit(4, 12);
	                }
	            }
	        }),
	        'select': {
	            fillColor: '#0078CC',
	            strokeColor: '#004E85'
	        }
	    }),
	    eventListeners: {
	    	loadstart: function(){
	    		loading.injectTop(this.div);
	    	},
	    	loadend: function(){
	    		var last = loading.getLast();
	    		last.get('tween').setOptions({ duration: 1500 }).start('opacity', 0).chain(loading.dispose.bind(loading));
	    		if (!bounded) bounded = true;
	    		map.zoomToExtent(photoBounds);
	    	},
	    	scope: map,
	    	featureadded: function(event){
	    		if (!bounded) photoBounds.extend(event.feature.geometry);
	    	},
	    	featureselected: function(feature){
	    		// hover
	    	}
	    }
	});
	
	var hover = new OpenLayers.Control.SelectFeature(photos, {
		hover: true,
		callbacks: {
			click: function(){
				
			},
			dblclick: function(layer){
				var bounds = new OpenLayers.Bounds();
				layer.cluster.each(function(point){
					bounds.extend(point.geometry);
				});
				map.zoomToExtent(bounds, 1);
			}
		}
	});
	map.addControl(hover);
	map.addLayer(photos);
	hover.activate();
});