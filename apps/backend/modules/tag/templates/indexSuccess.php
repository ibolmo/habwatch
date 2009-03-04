<h2>Tagger</h2>

<h4>Instructions <a href="javascript:void(0)" class="toggle" rel="tagger-instructions">-</a></h4>
<div id="tagger-instructions">
    <dl>
        <dt>Goal:</dt>
        <dd>Select the best picture(s)</dd>
    </dl>
    <p>
        You can select by click and dragging across a set of pictures,
            <blockquote>and/or</blockquote>
        Press and hold <code>shift</code> while clicking on each picture.
    </p>
</div>

<div id="tagger" class="block">
    <?php if ($PhotoPager->haveToPaginate()): ?>    
        <?= include_partial('tag/nav', array('PhotoPager' => $PhotoPager)) ?>
        <hr />
    <?php endif ?>
    
    <?php foreach ($PhotoPager->getResults() as $i => $Photo): ?>
        <div class="inline <?= $Photo->hasTag('useful') ? 'green' : ''?>"><img id="<?= $Photo->getId() ?>" alt="<?= $Photo->getDescription() ?>" src="<?= $Photo->buildImgUrl() ?>" /></div>
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