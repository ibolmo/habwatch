<div class="block">
	<?php if (Flickr::hasPhotos()): ?>
	    <iframe id="map" name="map" src="http://www.flickr.com/photos/35147405@N02/map" style="margin-top: -60px" width="100%" height="800" marginwidth="0" marginheight="0" frameborder="no" scrolling="no">Please upgrade your browser</iframe>
	<?php else: ?>
	    <h2>Welcome to <?php echo sfConfig::get('app_project_name') ?>!</h2>
	    <?= include_partial('default/intro') ?>
    <?php endif ?>
</div>