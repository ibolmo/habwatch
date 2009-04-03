<?php if (isset($introduce)): ?>
    <div id="introduction" class="squeezebox invisible">
        <h3>Welcome to <?= sfConfig::get('app_project_name') ?></h3>
        <?= include_partial('default/intro') ?>
    </div>
<?php endif ?>

<?php if (Flickr::hasPhotos()): ?>
	<div id="map-content" class="column span-3 append-1">
        <h3>Recent</h3>
        <ul id="sidebar-recent" class="log">
            <?php foreach (Flickr::getRecentPhotos(3) as $Photo): ?>
                <li>
                    <a href="<?= $Photo->buildUrl() ?>">
                        <img class="thumbnail" alt="<?= $Photo->getDescription() ?>" src="<?= $Photo->buildImgUrl() ?>" />
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
	</div>
	<?php 
		use_stylesheet('openlayers/style');
		use_javascript('mootools');
		use_javascript('openlayers');
		use_javascript('http://www.openstreetmap.org/openlayers/OpenStreetMap.js');
		use_dynamic_javascript('@config-openlayers');
		use_javascript('default/map.js');
	?>
    <div id="map" class="column span-16"></div>
    
	<div id="map-filters" class="column span-3 prepend-1">
        <?php use_javascript('mootools') ?>
    	<?php use_javascript('flickr-tags') ?>
    	<h3>Filter By Tags</h3>
    	<ul id="flickr-tags" class="log">
            <?php foreach (Flickr::getPopularTags(10, true) as $tag): ?>
        	    <li><a href="http://www.flickr.com/photos/<?= Flickr::getUser()->getId() ?>/tags/<?= $tag ?>"><?= $tag ?></a></li>
            <?php endforeach ?>
    	</ul>
	</div>
<?php else: ?>
    <h2>Welcome to <?php echo sfConfig::get('app_project_name') ?>!</h2>
    <?= include_partial('default/intro') ?>
<?php endif ?>
