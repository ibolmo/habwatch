<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Report filter form base class.
 *
 * @package    filters
 * @subpackage Report *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseReportFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'        => new sfWidgetFormFilterInput(),
      'quantity'    => new sfWidgetFormFilterInput(),
      'condition'   => new sfWidgetFormFilterInput(),
      'subject'     => new sfWidgetFormFilterInput(),
      'location_id' => new sfWidgetFormFilterInput(),
      'message_id'  => new sfWidgetFormFilterInput(),
      'storage_id'  => new sfWidgetFormDoctrineChoice(array('model' => 'Storage', 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'        => new sfValidatorPass(array('required' => false)),
      'quantity'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'condition'   => new sfValidatorPass(array('required' => false)),
      'subject'     => new sfValidatorPass(array('required' => false)),
      'location_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'message_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'storage_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Storage', 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('report_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Report';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'file'        => 'Text',
      'quantity'    => 'Number',
      'condition'   => 'Text',
      'subject'     => 'Text',
      'location_id' => 'Number',
      'message_id'  => 'Number',
      'storage_id'  => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}