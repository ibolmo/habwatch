<p>
    Hello <?php echo $sfGuardUser; ?>,
</p>

<p>
    <?php echo link_to('Click here to confirm your registration', url_for('@sf_guard_register_confirm?key='.$sfGuardUser->getPassword().'&username='.$sfGuardUser, true)); ?>
</p>