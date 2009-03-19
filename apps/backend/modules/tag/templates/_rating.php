<ul class="star-rating"> 
    <li class="current-rating" style="width:<?= $Rating->getPercent() ?>">Currently <?= $Rating ?>/<?= $Rating->nbrStars ?> Stars.</li>
	<?php foreach ($Rating->getStars() as $Star): ?>
	    <?= $Star ?>
	<?php endforeach ?>
</ul>