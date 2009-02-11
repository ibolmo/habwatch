<div class="block">
	<?php if (Map::hasData()): ?>
	    <iframe id="main" src="http://www.flickr.com/photos/35147405@N02/tags/valid/map" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="no" scrolling="no">Please upgrade your browser</iframe>
	<iframe id="main" src="http://www.flickr.com/photos/35147405@N02/tags/valid/map" width="100%" height="100%" marginwidth="0" marginheight="0" frameborder="no" scrolling="no">Please upgrade your browser</iframe>
	<?php else: ?>
	    <h2>Welcome to <?php echo sfConfig::get('app_project_name') ?>!</h2>
	    <?= include_partial('default/intro') ?>
    <?php endif ?>
</div>
