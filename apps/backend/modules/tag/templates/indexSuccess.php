<h2>Tagger</h2>

<h4>Instructions <a href="javascript:void(0)" class="toggle" rel="tagger-instructions">-</a></h4>
<div id="tagger-instructions">
    <dl>
        <dt>Goal:</dt>
        <dd>Rate the picture(s) for its usefulness</dd>
    </dl>
    <p>
        Just click on the stars below the pictures to set the rating for the picture.
    </p>
</div>

<div id="tagger" class="block">
    <?php if ($PhotoPager->haveToPaginate()): ?>    
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
        <hr />
    <?php endif ?>
    
    <?php foreach ($PhotoPager->getResults() as $i => $Photo): ?>
        <div class="photo_box inline">
            <div><img id="<?= $Photo->getId() ?>" alt="<?= $Photo->getDescription() ?>" src="<?= $Photo->buildImgUrl() ?>" /></div>
            <ul class="star-rating"> 
        		<li class="current-rating" style="width:60%;">Currently 3/5 Stars.</li> 
        		<li><a href="#" title="1 star out of 5" class="one-star">1</a></li> 
        		<li><a href="#" title="2 stars out of 5" class="two-stars">2</a></li> 
        		<li><a href="#" title="3 stars out of 5" class="three-stars">3</a></li> 
        		<li><a href="#" title="4 stars out of 5" class="four-stars">4</a></li> 
        		<li><a href="#" title="5 stars out of 5" class="five-stars">5</a></li> 
        	</ul> 
        </div>
    <?php endforeach ?>
    
    <?php if ($PhotoPager->haveToPaginate()): ?>
        <hr />
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
    <?php endif ?>
</div>

<?php slot('sidebar') ?>
<h2>Selected</h2>
<ul id="tagger-selected" class="log"></ul>
<?php end_slot() ?>