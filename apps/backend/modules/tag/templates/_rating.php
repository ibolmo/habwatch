<ul class="star-rating"> 
    <?= $Rating->getCurrent() ?>
	<?php foreach ($Rating->getStars() as $Star): ?>
	    <?= $Star ?>
	    <?php /*<li><a href="#" title="<?= $Star->getTitle() ?>" class="<?= $Star->getSlog() ?>"><?= $Star ?></a></li>  */?>
	<?php endforeach ?>
</ul>