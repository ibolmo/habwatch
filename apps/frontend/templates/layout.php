<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <?php include_title() ?>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_stylesheets() ?>
        <?php echo stylesheet_tag('blueprintcss/print', array('media' => 'print')) ?>
        <!--[if IE]><?php echo stylesheet_tag('blueprintcss/ie') ?><![endif]-->
	</head>
	<body>
		<div class="container">
	    	<div id="header" class="block">
	    		<div class="column span-21">
	    			<h1 id="logo"><?php echo sfConfig::get('app_project_name') ?></h1>
	    		</div>
		    	<div id="top_nav" class="column span-3 right">
		    	    <?php include_partial('default/top_nav')?>
	    		</div>
	    		<div class="column span-24">
	    			<?php //$this->load->view('partials/menu.tpl.php') ?>
	    		</div>
	    	</div>
		    <div id="body" class="block">	
    			<?php if (@$heading): ?>
    			<h2><?php echo $heading ?></h2>
    			<?php endif ?>
    			<?php foreach (array('errors' => 'error', 'notices' => 'notice', 'successes' => 'success') as $type => $class): ?>		
    			<?php if (@${$type}): ?>
    				<ul id="page_<?php echo $type ?>" class="log <?php echo $class ?>">
    					<?php foreach (${$type} as $item): ?>
    					<li><?php echo $item ?></li>
    					<?php endforeach ?>
    				</ul>
    			<?php endif ?>
    			<?php endforeach ?>
				<?php echo $sf_content ?>
			</div>
			<hr class="space" />
			<hr />
			<div id="footer" class="block">
	        	<?php include_partial('default/footer') ?>
	        </div>
		</div>
		<?php include_javascripts() ?>
	</body>
</html>