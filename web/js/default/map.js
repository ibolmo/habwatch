window.addEvent('load', function(){

    map = new OpenLayers.Map('map');
    map.addControl(new OpenLayers.Control.LayerSwitcher());
    
    var gphy = new OpenLayers.Layer.Google('Google Physical', {
        type: G_PHYSICAL_MAP   
    });
    
    var gmap = new OpenLayers.Layer.Google('Google Streets', {
        numZoomLevels: 20
    });
    
    var ghyb = new OpenLayers.Layer.Google('Google Hybrid', {
        type: G_HYBRID_MAP,
        numZoomLevels: 20
    });
    
    var gsat = new OpenLayers.Layer.Google('Google Satellite', {
        type: G_SATELLITE_MAP,
        numZoomLevels: 20
    });

    map.addLayers([gphy, gmap, ghyb, gsat]);
    map.setCenter(new OpenLayers.LonLat(10.2, 48.9), 5);
	
});