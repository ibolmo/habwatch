<dl>
    <?php foreach (array('description', 'tags', 'rating') as $topic): ?>
        <?php if (isset($Info[$topic])): ?>
            <dt><?= ucwords($topic) ?></dt>
            <dd>
                <?= $Info[$topic] ?>
            </dd>
        <?php endif ?>
    <?php endforeach ?>
</dl>