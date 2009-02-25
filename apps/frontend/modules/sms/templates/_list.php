<h2>SMS</h2>
<table class="messages">
    <tr>
        <th>From</th>
        <th>Message</th>
    </tr>
<?php foreach ($messages as $i => $message): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="from phone_number">
            <?= $message['from'] ?>
        </td>
        <td class="message">
            <?= $message['message'] ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>