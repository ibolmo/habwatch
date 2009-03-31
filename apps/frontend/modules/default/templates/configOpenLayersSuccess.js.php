HABWatch = HABWatch || {};
HABWatch.Flickr = HABWatch.Flickr || {};
HABWatch.Flickr.URI = '<?= url_for("@flickr-pub-geojson") ?>';

OpenLayers.ImgPath = '<?= $sf_request->getRelativeUrlRoot() ?>images/openlayers/';
OpenLayers.Util.OSM.MISSING_TILE_URL = OpenLayers.ImgPath + 'blank.gif';