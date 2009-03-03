<?php if (!$sf_user->isAuthenticated()): ?>
    <?php echo link_to('Log in', '@sf_guard_signin') ?>
<?php else: ?>
    <?php echo link_to('Log out', '@sf_guard_signout') ?>
<?php endif ?>

