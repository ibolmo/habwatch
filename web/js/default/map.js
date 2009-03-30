window.addEvent('load', function(){
    OpenLayers.ImgPath = '/images/openlayers/';
    
	var map = new OpenLayers.Map('map', {
		projection: new OpenLayers.Projection("EPSG:900913"),
		internalProjection: new OpenLayers.Projection("EPSG:900913"),
		externalProjection: new OpenLayers.Projection("EPSG:4326"),
		displayProjection: new OpenLayers.Projection("EPSG:4326"),
	    units: "m",
	    maxResolution: 156543.0339,
	    maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34, 20037508.34, 20037508.34),
	    theme: null
	});
	
	// create Google Mercator layers
	var osm = new OpenLayers.Layer.OSM.Mapnik("OSM");
    map.addLayer(osm);
    
    var proj = new OpenLayers.Projection("EPSG:4326");
	var point = new OpenLayers.LonLat(-118.489609, 33.757989);
	map.setCenter(point.transform(proj, map.getProjectionObject()), 10);
});