<?php

/**
 * SMS form base class.
 *
 * @package    form
 * @subpackage sms
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSMSForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'file'              => new sfWidgetFormTextarea(),
      'sf_guard_user_id'  => new sfWidgetFormDoctrineSelect(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'campaign_id'       => new sfWidgetFormInput(),
      'from'              => new sfWidgetFormInput(),
      'to'                => new sfWidgetFormInput(),
      'message'           => new sfWidgetFormTextarea(),
      'type'              => new sfWidgetFormInput(),
      'carbon_copy'       => new sfWidgetFormTextarea(),
      'blind_carbon_copy' => new sfWidgetFormTextarea(),
      'subject'           => new sfWidgetFormTextarea(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorDoctrineChoice(array('model' => 'SMS', 'column' => 'id', 'required' => false)),
      'file'              => new sfValidatorString(array('required' => false)),
      'sf_guard_user_id'  => new sfValidatorDoctrineChoice(array('model' => 'sfGuardUser', 'required' => false)),
      'campaign_id'       => new sfValidatorInteger(array('required' => false)),
      'from'              => new sfValidatorString(array('max_length' => 125, 'required' => false)),
      'to'                => new sfValidatorString(array('max_length' => 125, 'required' => false)),
      'message'           => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'type'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'carbon_copy'       => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'blind_carbon_copy' => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'subject'           => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sms[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SMS';
  }

}