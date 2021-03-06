<?php

/**
 * EmailAddress form.
 *
 * @package    form
 * @subpackage EmailAddress
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class EmailAddressForm extends BaseEmailAddressForm
{
  public function configure()
  {
        unset($this['id'], $this->widgetSchema['profile_id']);
        $this->validatorSchema['address'] = new sfValidatorEmailAddress();
  }
}