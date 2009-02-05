<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Coordinate filter form base class.
 *
 * @package    filters
 * @subpackage Coordinate *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCoordinateFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'       => new sfWidgetFormFilterInput(),
      'latitude'   => new sfWidgetFormFilterInput(),
      'longitude'  => new sfWidgetFormFilterInput(),
      'report_id'  => new sfWidgetFormDoctrineChoice(array('model' => 'Report', 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'       => new sfValidatorPass(array('required' => false)),
      'latitude'   => new sfValidatorPass(array('required' => false)),
      'longitude'  => new sfValidatorPass(array('required' => false)),
      'report_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Report', 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('coordinate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Coordinate';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'file'       => 'Text',
      'latitude'   => 'Text',
      'longitude'  => 'Text',
      'report_id'  => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}