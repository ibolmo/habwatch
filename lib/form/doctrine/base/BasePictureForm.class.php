<?php

/**
 * Picture form base class.
 *
 * @package    form
 * @subpackage picture
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BasePictureForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'still'      => new sfWidgetFormTextarea(),
      'resolution' => new sfWidgetFormInput(),
      'quality'    => new sfWidgetFormInput(),
      'format'     => new sfWidgetFormInput(),
      'storage_id' => new sfWidgetFormDoctrineSelect(array('model' => 'Storage', 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'Picture', 'column' => 'id', 'required' => false)),
      'still'      => new sfValidatorString(array('required' => false)),
      'resolution' => new sfValidatorInteger(array('required' => false)),
      'quality'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'format'     => new sfValidatorString(array('max_length' => 25, 'required' => false)),
      'storage_id' => new sfValidatorDoctrineChoice(array('model' => 'Storage', 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('picture[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Picture';
  }

}