<?php

/**
 * Storage form base class.
 *
 * @package    form
 * @subpackage storage
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseStorageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'Storage', 'column' => 'id', 'required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser')),
    ));

    $this->widgetSchema->setNameFormat('storage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Storage';
  }

}