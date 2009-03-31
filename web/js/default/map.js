window.addEvent('domready', function(){
	
	var map = new OpenLayers.Map('map', {
		maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
        maxResolution: 156543.0399,
        numZoomLevels: 20,
    	displayProjection: new OpenLayers.Projection("EPSG:4326"),
        units: 'm',
        theme: null,
	    controls: [
		    new OpenLayers.Control.Navigation(),
			new OpenLayers.Control.ArgParser(),
			new OpenLayers.Control.Attribution(),
		]
	});
	
	var osm = new OpenLayers.Layer.OSM.Mapnik('OSM', {
		displayOutsideMaxExtent: true,
	    wrapDateLine: true,
	    renderers: ['SVG', 'Canvas', 'VML']
	});
	osm.url = ([
		'http://a.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
		'http://b.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/',
		'http://c.tile.cloudmade.com/9ea55b2fb8ff5059accd298987268530/4/256/'
	]);
    map.addLayer(osm);
    map.setCenter(new OpenLayers.LonLat(-118.489609, 33.757989).transform(new OpenLayers.Projection('EPSG:4326'), map.getProjectionObject()), 10);
    
    var photos = new OpenLayers.Layer.Vector("Photos", {
	    strategies: [
	        new OpenLayers.Strategy.Fixed(),
	        new OpenLayers.Strategy.Cluster()
	    ],
	    protocol: new OpenLayers.Protocol.HTTP({
	        url: HABWatch.Flickr.URL,
	        params: {
	            format: "WFS",
	            sort: "interestingness-desc",
	            service: "WFS",
	            request: "GetFeatures",
	            srs: "EPSG:4326",
	            maxfeatures: 150,
	            bbox: [-180, -90, 180, 90]
	        },
	        format: new OpenLayers.Format.GML()
	    }),
	    styleMap: new OpenLayers.StyleMap({
	        "default": new OpenLayers.Style({
	            pointRadius: "${radius}",
	            fillColor: "#ffcc66",
	            fillOpacity: 0.8,
	            strokeColor: "#cc6633",
	            strokeWidth: 2,
	            strokeOpacity: 0.8
	        }, {
	            context: {
	                radius: function(feature) {
	                    return Math.min(feature.attributes.count, 7) + 3;
	                }
	            }
	        }),
	        "select": {
	            fillColor: "#8aeeef",
	            strokeColor: "#32a8a9"
	        }
	    })
	});
	
	var select = new OpenLayers.Control.SelectFeature(photos, {hover: true});
	map.addControl(select);
	map.addLayer(photos);
	select.activate();
	//photos.events.on({"featureselected": display});
});