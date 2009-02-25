<h2>SMS</h2>
<table class="messages">
    <tr>
        <th>From</th>
        <th>Message</th>
    </tr>
<?php foreach ($sms as $i => $s): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="from phone_number">
            <?= $s['from'] ?>
        </td>
        <td class="message">
            <?= $s['message'] ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>