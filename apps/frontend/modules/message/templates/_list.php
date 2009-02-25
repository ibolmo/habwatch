<?= include_partial('sms/list', array('sms' => $sms )) ?>

<?php if ($emails->count()): ?>
    <hr />
    <?= include_partial('email/list', array('emails' => $emails )) ?>
<?php endif ?>