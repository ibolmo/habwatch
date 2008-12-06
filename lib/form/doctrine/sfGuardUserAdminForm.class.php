<?php

/**
 * sfGuardUserAdminForm for admin generators
 *
 * @package form
 * @package sf_guard_user
 */
class sfGuardUserAdminForm extends BasesfGuardUserAdminForm
{
    public function configure()
    {
      parent::configure();
     
      $profileForm = new ProfileForm($this->object->Profile);
      unset($profileForm['id'], $profileForm['sf_guard_user_id']);
      $this->embedForm('Profile', $profileForm);
    }
}