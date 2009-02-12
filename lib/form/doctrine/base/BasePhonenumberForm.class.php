<?php

/**
 * PhoneNumber form base class.
 *
 * @package    form
 * @subpackage phone_number
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePhoneNumberForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'number'     => new sfWidgetFormInput(),
      'disabled'   => new sfWidgetFormInputCheckbox(),
      'profile_id' => new sfWidgetFormDoctrineSelect(array('model' => 'Profile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'PhoneNumber', 'column' => 'id', 'required' => false)),
      'number'     => new sfValidatorString(array('max_length' => 14)),
      'disabled'   => new sfValidatorBoolean(array('required' => false)),
      'profile_id' => new sfValidatorDoctrineChoice(array('model' => 'Profile', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phone_number[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhoneNumber';
  }

}