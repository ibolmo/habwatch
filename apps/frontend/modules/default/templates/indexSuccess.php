<?php if (isset($introduce)): ?>
    <div id="introduction" class="squeezebox invisible">
        <h3>Welcome to <?= sfConfig::get('app_project_name') ?></h3>
        <?= include_partial('default/intro') ?>
    </div>
<?php endif ?>

<div class="block">
    <?php if (Flickr::hasPhotos()): ?>
    	<?php 
    		use_stylesheet('openlayers/style');
    		use_javascript('mootools');
    		//use_javascript('http://maps.google.com/maps?file=api&amp;v=2&amp;key='.sfConfig::get('app_google_maps_key'));
    		use_javascript('openlayers');
    		use_javascript('http://www.openstreetmap.org/openlayers/OpenStreetMap.js');
    		use_javascript('default/map.js');
    	?>
        <div id="map"></div>
    <?php else: ?>
        <h2>Welcome to <?php echo sfConfig::get('app_project_name') ?>!</h2>
        <?= include_partial('default/intro') ?>
    <?php endif ?>
</div>
