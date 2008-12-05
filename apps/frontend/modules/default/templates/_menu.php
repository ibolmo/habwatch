
<?php if ($links): ?>
<ul class="tabs">
    <?php foreach ($links as $uri => $link): ?>
        <?php //if (isset($link['visible'])): ?>
            <li><?php echo link_to($link['text'], $uri, ($requestedUri == url_for($uri, true)) ? array('class' => 'active') : array()) ?></li>
        <?php //endif ?>
    <?php endforeach ?>
</ul>
<?php endif ?>