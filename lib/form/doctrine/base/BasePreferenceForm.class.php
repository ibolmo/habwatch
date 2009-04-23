<?php

/**
 * Preference form base class.
 *
 * @package    form
 * @subpackage preference
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePreferenceForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'enabled'    => new sfWidgetFormInputCheckbox(),
      'datum_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Datum', 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'Preference', 'column' => 'id', 'required' => false)),
      'enabled'    => new sfValidatorBoolean(array('required' => false)),
      'datum_id'   => new sfValidatorDoctrineChoice(array('model' => 'Datum', 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('preference[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Preference';
  }

}