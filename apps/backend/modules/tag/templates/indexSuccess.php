<?php slot('no-sidebar') ?>1<?php end_slot() ?>

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
    <?php endif ?>
    
    <?php foreach ($PhotoPager->getResults() as $i => $Photo): ?>
        <div class="photo_box inline">
            <img id="<?= $Photo->getId() ?>" alt="<?= $Photo->getDescription() ?>" src="<?= $Photo->buildImgUrl() ?>" />
            <?= include_partial('tag/rating', array('Rating' => $Photo->getRating())) ?>
        </div>
    <?php endforeach ?>
    
    <?php if ($PhotoPager->haveToPaginate()): ?>
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
    <?php endif ?>
</div>