<h2>Tagger</h2>
<div id="tagger" class="block">
    <?php if ($PhotoPager->haveToPaginate()): ?>    
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
        <hr />
    <?php endif ?>
    
    <?php foreach ($PhotoPager->getResults() as $i => $Photo): ?>
        <img class="span-4" alt="<?= $Photo->getDescription() ?>" src="<?= $Photo->buildImgUrl() ?>" />
    <?php endforeach ?>
    
    <?php if ($PhotoPager->haveToPaginate()): ?>
        <hr />
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
    <?php endif ?>
</div>