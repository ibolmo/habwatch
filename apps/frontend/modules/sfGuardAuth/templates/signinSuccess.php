<p>Ready to interact with <strong><?php echo sfConfig::get('app_project_name') ?></strong>?  Well, just simply login.</p>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
    <table>
        <?php echo $form ?>
    </table>
    
    <p><input type="submit" value="sign in" /><a href="<?php echo url_for('@sf_guard_password') ?>">Forgot your password?</a></p>
</form>
