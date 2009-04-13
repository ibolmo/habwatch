if (!window.HABWatch) HABWatch = {};
if (!HABWatch.Flickr) HABWatch.Flickr = {};
HABWatch.Flickr.URL = '<?= url_for("@flickr-pub-geojson") ?>';

OpenLayers.ImgPath = '<?= $sf_request->getRelativeUrlRoot() ?>images/openlayers/';