<h2>Emails</h2>
<table class="messages">
    <tr>
        <th>From</th>
        <th>Subject</th>
        <th>Message</th>
    </tr>
<?php foreach ($emails as $i => $email): ?>
    <tr class="<?php echo fmod($i, 2) ? 'even' : 'odd' ?>">
        <td class="from phone_number">
            <?= $email['from'] ?>
        </td>
        <td class="subject">
            <?= $email['subject'] ?>
        </td>
        <td class="message">
            <?= $email['message'] ?>
        </td>
    </tr>
<?php endforeach; ?>
</table>