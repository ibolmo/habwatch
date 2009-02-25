<?= include_partial('sms/list', array('sms' => $SMSPager->getResults() )) ?>
<?php if ($SMSPager->haveToPaginate()): ?>
    <div class="pagination">
        <a href="<?= url_for('@messages') ?>?sms_page=1">&laquo;</a>
        <a href="<?= url_for('@messages') ?>?sms_page=<?= $SMSPager->getPreviousPage() ?>">&lsaquo;</a>
        
        <?php foreach ($SMSPager->getLinks() as $page): ?>
            <?php if ($page == $SMSPager->getPage()): ?>
                <?= $page ?>
            <?php else: ?>
                <a href="<?= url_for('@messages') ?>?sms_page=<?= $page ?>"><?= $page ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
        
        <a href="<?= url_for('@messages') ?>?sms_page=<?= $SMSPager->getNextPage() ?>">&rsaquo;</a>
        <a href="<?= url_for('@messages') ?>?sms_page=<?= $SMSPager->getLastPage() ?>">&raquo;</a>
    </div>
<?php endif; ?>

<?php if (isset($emails) && $emails->count()): ?>
    <hr />
    <?= include_partial('email/list', array('emails' => $emails )) ?>
<?php endif ?>