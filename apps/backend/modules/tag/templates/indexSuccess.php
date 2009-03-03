<h2>Tagger</h2>
<div id="tagger" class="block">
    <?php if ($PhotoPager->haveToPaginate()): ?>    
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
        <hr />
    <?php endif ?>
    
    <?php foreach ($PhotoPager->getResults() as $i => $Photo): ?>
        <div class="span-5 inline"><img alt="<?= $Photo->getDescription() ?>" src="<?= $Photo->buildImgUrl() ?>" /></div>
    <?php endforeach ?>
    
    <?php if ($PhotoPager->haveToPaginate()): ?>
        <hr />
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
    <?php endif ?>
</div>