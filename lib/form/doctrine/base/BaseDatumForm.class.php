<?php

/**
 * Datum form base class.
 *
 * @package    form
 * @subpackage datum
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseDatumForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'file'             => new sfWidgetFormTextarea(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineSelect(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'campaign_id'      => new sfWidgetFormInput(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'Datum', 'column' => 'id', 'required' => false)),
      'file'             => new sfValidatorString(array('required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'campaign_id'      => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('datum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Datum';
  }

}