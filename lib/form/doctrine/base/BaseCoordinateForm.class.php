<?php

/**
 * Coordinate form base class.
 *
 * @package    form
 * @subpackage coordinate
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseCoordinateForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'file'       => new sfWidgetFormTextarea(),
      'latitude'   => new sfWidgetFormTextarea(),
      'longitude'  => new sfWidgetFormTextarea(),
      'report_id'  => new sfWidgetFormDoctrineSelect(array('model' => 'Report', 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => 'Coordinate', 'column' => 'id', 'required' => false)),
      'file'       => new sfValidatorString(array('required' => false)),
      'latitude'   => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'longitude'  => new sfValidatorString(array('max_length' => 2147483647, 'required' => false)),
      'report_id'  => new sfValidatorDoctrineChoice(array('model' => 'Report', 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('coordinate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Coordinate';
  }

}