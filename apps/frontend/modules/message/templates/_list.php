<?= include_partial('sms/list', array('sms' => $sms )) ?>

<?php if (isset($emails) && $emails->count()): ?>
    <hr />
    <?= include_partial('email/list', array('emails' => $emails )) ?>
<?php endif ?>