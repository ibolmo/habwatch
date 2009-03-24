<div class="column span-18 quiet medium">
    <?php echo link_to('Contact Us', '@contact') ?>
		&middot; <?php echo link_to('Terms of Service', '@terms') ?>
	<?php if ($sf_user->isAuthenticated()): ?>
		&middot; <?php echo link_to('Instructions', '@instructions') ?> 
	<?php endif ?>
</div>
<div class="column span-8 right quiet small">
	&copy; 2007 - <?php echo date("Y"); ?> <?= sfConfig::get('app_project_copyright') ?> &middot; All Rights Reserved.
</div>