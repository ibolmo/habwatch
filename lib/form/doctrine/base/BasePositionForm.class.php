<?php

/**
 * Position form base class.
 *
 * @package    form
 * @subpackage position
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePositionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'file'                => new sfWidgetFormTextarea(),
      'latitude'            => new sfWidgetFormInput(),
      'altitude'            => new sfWidgetFormInput(),
      'vertical_accuracy'   => new sfWidgetFormInput(),
      'longitude'           => new sfWidgetFormInput(),
      'horizontal_accuracy' => new sfWidgetFormInput(),
      'g_p_s_id'            => new sfWidgetFormDoctrineSelect(array('model' => 'GPS', 'add_empty' => true)),
      'data_id'             => new sfWidgetFormDoctrineSelect(array('model' => 'Data', 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorDoctrineChoice(array('model' => 'Position', 'column' => 'id', 'required' => false)),
      'file'                => new sfValidatorString(array('required' => false)),
      'latitude'            => new sfValidatorNumber(array('required' => false)),
      'altitude'            => new sfValidatorNumber(array('required' => false)),
      'vertical_accuracy'   => new sfValidatorNumber(array('required' => false)),
      'longitude'           => new sfValidatorNumber(array('required' => false)),
      'horizontal_accuracy' => new sfValidatorNumber(array('required' => false)),
      'g_p_s_id'            => new sfValidatorDoctrineChoice(array('model' => 'GPS', 'required' => false)),
      'data_id'             => new sfValidatorDoctrineChoice(array('model' => 'Data', 'required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('position[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Position';
  }

}