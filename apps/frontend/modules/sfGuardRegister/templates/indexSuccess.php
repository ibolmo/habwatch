<h2>Register</h2>

<p>Don't have an account on <strong><?php echo sfConfig::get('app_project_name') ?></strong>?  Well register!

<?php echo $form->renderFormTag(url_for('@sf_guard_register')) ?>
    <table>
        <?php echo $form ?>
    </table>
    <input type="submit" name="register" value="Register" />
</form>