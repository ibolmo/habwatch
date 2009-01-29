<?php

/**
 * PhoneNumber form.
 *
 * @package    form
 * @subpackage PhoneNumber
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class PhoneNumberForm extends BasePhonenumberForm
{
    public function configure()
    {
        unset($this['id'], $this->widgetSchema['profile_id']);
        $this->validatorSchema['number'] = new sfValidatorPhoneNumber();
    }
}