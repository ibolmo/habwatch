<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>
            <?php if (!include_slot('title')): ?>
                <?= sfConfig::get('app_project_name') ?>
            <?php endif ?>
        </title>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_stylesheets() ?>
        <?= stylesheet_tag('blueprintcss/blueprint/src/print', array('media' => 'print')) ?>
        <!--[if IE]><?= stylesheet_tag('blueprintcss/blueprint/src/ie') ?><![endif]-->
	</head>
	<body>
		<div class="container">
		    
	    	<div id="header" class="block">
	    		<div class="column span-21">
	    			<h1 id="logo"><?= link_to(sfConfig::get('app_project_name'), '@homepage') ?></h1>
	    		</div>
		    	<div id="top_nav" class="column last span-3 right">
		    	    <?php include_partial('default/top_nav')?>
	    		</div>
	    		<div id="menu" class="column span-24">
	    		    <?php include_component('default', 'menu') ?>
	    		</div>
	    	</div>
	    	
	    	<div id="notices" class="block">
		        <?php foreach (array('error', 'notice', 'success') as $type): ?>
    		        <?php if ($sf_user->hasFlash($type)): ?>
    		            <div class="flash <?= $type ?>"><?= $sf_user->getFlash($type) ?></div>
    		        <?php endif ?>
		        <?php endforeach ?>	    	    
	    	</div>
	    	
		    <div id="body" class="block">
			    <div id="content" class="column span-<?= has_slot('no-sidebar') ? 24 : 20 ?>">
			        <?= $sf_content ?>
			    </div>
			    
			    <div id="sidebar" class="column span-3 prepend-1">
                	<?php if (!has_slot('no-sidebar') && !include_slot('sidebar') && (!isset($sidebar) || $sidebar)): ?>
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
                    	
                    	<h3>Tags</h3>
                    	<ul class="log">
                            <?php foreach (Flickr::getPopularTags() as $tag): ?>
                        	    <li><a href="http://www.flickr.com/photos/<?= Flickr::getUser()->getId() ?>/tags/<?= $tag ?>"><?= $tag ?></a></li>
                            <?php endforeach ?>
                    	</ul>
                    <?php endif ?>
			    </div>
			</div>
			
			<hr class="space" />
			<hr />
			
			<div id="footer" class="block">
			    <div id="footer-fat"></div>
	        	<?php include_partial('default/footer') ?>
	        </div>
	        
		</div>
		<?php include_javascripts() ?>
		<?php if (!preg_match('/^dev/', $_SERVER['HTTP_HOST'])): ?>
    		<script src="http://www.google-analytics.com/ga.js" type="text/javascript"></script>
    	    <script>_gat._getTracker(<?= sfConfig::get('app_google_analytics') ?>)._trackPageview();</script>
		<?php endif ?>
	</body>
</html>