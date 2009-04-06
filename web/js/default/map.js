var Map = new Class({
	
	Implements: Options,
	
	options: {    
	    osm: {
	    	url: [
		        'http://a.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
		        'http://b.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
		        'http://c.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/'
		    ]
	    },
	    
	    longitude: -118.489609,
	    latitude: 33.757989,
	    
	    loading: {
	    	opacity: 0.7	
	    }
	},
	
	initialize: function(element, options){
		this.setOptions(options);
		this.element = $(element);
		this.configure();
	},
	
	configure: function(){
		this.boundary = new OpenLayers.Bounds();
	    this.bounded = false;
		
		var zoom = new OpenLayers.Control.ZoomPanel();
	    zoom.controls[1].trigger = function(){
	    	if (this.boundary) this.map.zoomToExtent(this.boundary);
	    }.bind(this);
		
		this.map = new OpenLayers.Map(this.element.id, {
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
	    
	    var osm = new OpenLayers.Layer.OSM.Mapnik('OSM', this.options.osm);
	    osm.url = this.options.osm.url;
	    this.map.addLayer(osm);
	    
	    this.reset({
	    	coordinate: new OpenLayers.LonLat(this.options.longitude, this.options.latitude).transform(new OpenLayers.Projection('EPSG:4326'), this.map.getProjectionObject()),
	    	zoom: 10	    	
	    });    
	    
	    this.vectors = {};
	    this.vectors.loading = new Element('div', {'id': 'map-loading'}).adopt(
	    	new Element('h3', {'class': 'text', 'html': 'Loading'}),
	    	new Element('div', {'class': 'background'}).setOpacity(this.options.loading.opacity)
	    );
	    
	    this.events = {};
	    this.events.photos = {
			loadstart: this.onLoadStart,
	    	loadend: this.onLoadEnd,
	    	featureadded: this.onPhotoAdded,
	    	featureselected: this.onPhotoMouseEnter,
	    	click: this.onPhotoClick,
	    	dblclick: this.onPhotoDblClick,
			scope: this
	    };
	    
	    this.vectors.photos = new OpenLayers.Layer.Vector('Photos', {
		    strategies: [
		        new OpenLayers.Strategy.Fixed({ preload: true }),
		        new OpenLayers.Strategy.Cluster()
		    ],
		    protocol: new OpenLayers.Protocol.HTTP({
		        url: this.options.photos.url,
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
		    eventListeners: this.events.photos
		});
		this.map.addLayer(this.vectors.photos);
		
		var hover = new OpenLayers.Control.SelectFeature(this.vectors.photos, {
			hover: true,
			callbacks: this.events.photos
		});
		this.map.addControl(hover);
		hover.activate();
	},
	
	reset: function(center){
		if (center) this.center = center;
		this.map.setCenter(this.center.coordinate, this.center.zoom);
	},
	
	onLoadStart: function(){
		this.vectors.loading.injectTop(this.element);
	},
	
	onLoadEnd: function(){
		this.vectors.loading.getLast().get('tween').start('opacity', 0).chain(function(){ this.vectors.loading.dispose(); }.bind(this));
		if (!this.bounded) this.bounded = true;
		this.map.zoomToExtent(this.boundary);
	},
	
	onPhotoAdded: function(event){
		if (!this.bounded) this.boundary.extend(event.feature.geometry);
	},
	
	onPhotoMouseEnter: function(feature){
		// hover
	},
	
	onPhotoClick: function(){
		
	},
	
	onPhotoDblClick: function(layer){
		var bounds = new OpenLayers.Bounds();
		layer.cluster.each(function(point){
			bounds.extend(point.geometry);
		});
		this.map.zoomToExtent(bounds, 1);
	}	

});

window.addEvent('load', function(){
    new Map('map', {
    	photos: {
    		url: HABWatch.Flickr.URL
    	}
    });
});