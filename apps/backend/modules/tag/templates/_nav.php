<div class="pagination">
    <a href="<?= url_for('@tag') ?>?page=1">&laquo;</a>
    <a href="<?= url_for('@tag') ?>?sms_page=<?= $PhotoPager->getPreviousPage() ?>">&lsaquo;</a>
    
    <?php foreach ($PhotoPager->getLinks() as $page): ?>
        <?php if ($page == $PhotoPager->getPage()): ?>
            <?= $page ?>
        <?php else: ?>
            <a href="<?= url_for('@tag') ?>?page=<?= $page ?>"><?= $page ?></a>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <a href="<?= url_for('@tag') ?>?page=<?= $PhotoPager->getNextPage() ?>">&rsaquo;</a>
    <a href="<?= url_for('@tag') ?>?page=<?= $PhotoPager->getLastPage() ?>">&raquo;</a>
</div>