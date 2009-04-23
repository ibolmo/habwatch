<?php

/**
 * EmailAddress form base class.
 *
 * @package    form
 * @subpackage email_address
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmailAddressForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'address'    => new sfWidgetFormInput(),
      'disabled'   => new sfWidgetFormInputCheckbox(),
      'profile_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Profile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'EmailAddress', 'column' => 'id', 'required' => false)),
      'address'    => new sfValidatorString(array('max_length' => 100)),
      'disabled'   => new sfValidatorBoolean(array('required' => false)),
      'profile_id' => new sfValidatorDoctrineChoice(array('model' => 'Profile', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'EmailAddress', 'column' => array('address')))
    );

    $this->widgetSchema->setNameFormat('email_address[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailAddress';
  }

}