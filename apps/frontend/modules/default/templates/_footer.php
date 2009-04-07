<div class="column span-8 quiet medium">
    <?php echo link_to('Contact Us', '@contact') ?>
		&middot; <?php echo link_to('Terms of Service', '@terms') ?>
	<?php if ($sf_user->isAuthenticated()): ?>
		&middot; <?php echo link_to('Instructions', '@instructions') ?> 
	<?php endif ?>
</div>
<div class="column span-7">
	<?= include_partial('default/sponsors_logos') ?>
</div>
<div class="column span-9 right quiet small">
	&copy; 2007 - <?php echo date("Y"); ?> <?= sfConfig::get('app_project_copyright') ?> &middot; All Rights Reserved.
</div>