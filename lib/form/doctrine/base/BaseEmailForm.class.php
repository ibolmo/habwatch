<?php

/**
 * Email form base class.
 *
 * @package    form
 * @subpackage email
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseEmailForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'address'    => new sfWidgetFormInput(),
      'profile_id' => new sfWidgetFormDoctrineSelect(array('model' => 'Profile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'Email', 'column' => 'id', 'required' => false)),
      'address'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'profile_id' => new sfValidatorDoctrineChoice(array('model' => 'Profile', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Email';
  }

}