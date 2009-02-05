<?php

/**
 * Report form base class.
 *
 * @package    form
 * @subpackage report
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseReportForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'file'        => new sfWidgetFormTextarea(),
      'quantity'    => new sfWidgetFormInput(),
      'condition'   => new sfWidgetFormTextarea(),
      'subject'     => new sfWidgetFormTextarea(),
      'location_id' => new sfWidgetFormInput(),
      'message_id'  => new sfWidgetFormInput(),
      'storage_id'  => new sfWidgetFormDoctrineSelect(array('model' => 'Storage', 'add_empty' => true)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => 'Report', 'column' => 'id', 'required' => false)),
      'file'        => new sfValidatorString(array('required' => false)),
      'quantity'    => new sfValidatorInteger(array('required' => false)),
      'condition'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'subject'     => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'location_id' => new sfValidatorInteger(array('required' => false)),
      'message_id'  => new sfValidatorInteger(array('required' => false)),
      'storage_id'  => new sfValidatorDoctrineChoice(array('model' => 'Storage', 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('report[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Report';
  }

}