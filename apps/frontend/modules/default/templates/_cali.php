<? use_helper('my') ?>
<? use_stylesheet('cali') ?>

<table id="cali" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
		    <th scope="col" id="cali-months" title="Calendar Year <?= $year ?>"><?= $year ?></th>
		    <?php foreach (range(1,31) as $day): ?>
			<th scope="col" id="cali-day-<?= $day ?>" title="<?= ordinal($day) ?> of <?= $year ?>"><?= $day ?></th>
		    <?php endforeach ?>
		</tr>
	</thead>
	<tbody>
	    <?php foreach (range(1,12) as $month_n): $time = strtotime("$month_n/1/$year"); $month_s = date('M', $time); ?>
		<tr id="cali-month-<?= $month_n ?>">
		    <td class="month" title="<?= date('F Y', $time) ?>"><?= $month_s ?></td>
		    <?php foreach (range(1,31) as $day): ?>
			<td id="cali-<?= $month_n ?>-<?= $day ?>" class="day" title="<?= date('D, d M Y', strtotime("$month_n/$day/$year")) ?>">&nbsp;</td>
		    <?php endforeach ?>
		</tr>
	    <?php endforeach ?>
	</tbody>
</table>