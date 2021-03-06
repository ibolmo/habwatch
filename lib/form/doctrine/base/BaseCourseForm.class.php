<?php

/**
 * Course form base class.
 *
 * @package    form
 * @subpackage course
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCourseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'file'             => new sfWidgetFormTextarea(),
      'speed'            => new sfWidgetFormInput(),
      'heading'          => new sfWidgetFormInput(),
      'heading_accuracy' => new sfWidgetFormInput(),
      'speed_accuracy'   => new sfWidgetFormInput(),
      'g_p_s_id'         => new sfWidgetFormDoctrineChoice(array('model' => 'GPS', 'add_empty' => true)),
      'storage_id'       => new sfWidgetFormDoctrineChoice(array('model' => 'Storage', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorDoctrineChoice(array('model' => 'Course', 'column' => 'id', 'required' => false)),
      'file'             => new sfValidatorString(array('required' => false)),
      'speed'            => new sfValidatorNumber(array('required' => false)),
      'heading'          => new sfValidatorNumber(array('required' => false)),
      'heading_accuracy' => new sfValidatorNumber(array('required' => false)),
      'speed_accuracy'   => new sfValidatorNumber(array('required' => false)),
      'g_p_s_id'         => new sfValidatorDoctrineChoice(array('model' => 'GPS', 'required' => false)),
      'storage_id'       => new sfValidatorDoctrineChoice(array('model' => 'Storage', 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('course[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Course';
  }

}