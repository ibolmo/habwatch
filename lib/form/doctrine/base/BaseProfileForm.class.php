<?php

/**
 * Profile form base class.
 *
 * @package    form
 * @subpackage profile
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'first_name'       => new sfWidgetFormInput(),
      'middle_name'      => new sfWidgetFormInput(),
      'last_name'        => new sfWidgetFormInput(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineSelect(array('model' => 'sfGuardUser', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'Profile', 'column' => 'id', 'required' => false)),
      'first_name'       => new sfValidatorString(array('max_length' => 128)),
      'middle_name'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'last_name'        => new sfValidatorString(array('max_length' => 100)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser')),
    ));

    $this->widgetSchema->setNameFormat('profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Profile';
  }

}