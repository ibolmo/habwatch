<div class="center">
    <?= image_tag($Photo->buildImgUrl(), array('id' => $Photo->getId(), 'class' => 'thumbnail', 'style' => 'width: auto', 'alt' => $Photo->getDescription())) ?>
</div>
<hr class="space" />
<hr />

<div class="block">
    <?= include_partial('flickr/info', array('Info' => $Info)) ?>
    <?php /* ?>
    <div class="column colborder span-11">
        <?= include_partial('flickr/info', array('Info' => $Info)) ?>
    </div>
    <div class="column span-12 last">
         right column
    </div>
    <?php */ ?>
</div>