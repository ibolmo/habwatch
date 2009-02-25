<div class="sub-header">
    <div class="feed"><a href="">Feed</a></div>
    <h2>SMS</h2>
</div>

<table class="messages">
    <tr>
        <?php if ($sf_user->isAuthenticated()): ?>
        <th>From</th>
        <?php endif ?>
        <th>Message</th>
    </tr>
<?php foreach ($sms as $i => $s): ?>
    <tr class="<?= fmod($i, 2) ? 'even' : 'odd' ?>">
        <?php if ($sf_user->isAuthenticated()): ?>
        <td class="from phone_number">
            <?= $s['from'] ?>
        </td>
        <?php endif ?>
        <td class="message">
            <?= $s['message'] ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>