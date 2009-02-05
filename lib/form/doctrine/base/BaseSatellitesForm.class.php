<?php

/**
 * Satellites form base class.
 *
 * @package    form
 * @subpackage satellites
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseSatellitesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'file'            => new sfWidgetFormTextarea(),
      'horizontal_dop'  => new sfWidgetFormInput(),
      'used_satellites' => new sfWidgetFormInput(),
      'vertical_dop'    => new sfWidgetFormInput(),
      'time'            => new sfWidgetFormInput(),
      'satellites'      => new sfWidgetFormInput(),
      'time_dop'        => new sfWidgetFormInput(),
      'g_p_s_id'        => new sfWidgetFormDoctrineSelect(array('model' => 'GPS', 'add_empty' => true)),
      'storage_id'      => new sfWidgetFormDoctrineSelect(array('model' => 'Storage', 'add_empty' => true)),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorDoctrineChoice(array('model' => 'Satellites', 'column' => 'id', 'required' => false)),
      'file'            => new sfValidatorString(array('required' => false)),
      'horizontal_dop'  => new sfValidatorNumber(array('required' => false)),
      'used_satellites' => new sfValidatorInteger(array('required' => false)),
      'vertical_dop'    => new sfValidatorNumber(array('required' => false)),
      'time'            => new sfValidatorNumber(array('required' => false)),
      'satellites'      => new sfValidatorInteger(array('required' => false)),
      'time_dop'        => new sfValidatorNumber(array('required' => false)),
      'g_p_s_id'        => new sfValidatorDoctrineChoice(array('model' => 'GPS', 'required' => false)),
      'storage_id'      => new sfValidatorDoctrineChoice(array('model' => 'Storage', 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('satellites[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Satellites';
  }

}