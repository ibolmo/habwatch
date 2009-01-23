<?php

/**
 * Emailaddress form base class.
 *
 * @package    form
 * @subpackage emailaddress
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmailaddressForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'address'    => new sfWidgetFormInput(),
      'profile_id' => new sfWidgetFormDoctrineSelect(array('model' => 'Profile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'Emailaddress', 'column' => 'id', 'required' => false)),
      'address'    => new sfValidatorString(array('max_length' => 100)),
      'profile_id' => new sfValidatorDoctrineChoice(array('model' => 'Profile', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Emailaddress', 'column' => array('address')))
    );

    $this->widgetSchema->setNameFormat('emailaddress[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Emailaddress';
  }

}