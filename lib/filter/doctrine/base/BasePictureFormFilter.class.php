<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Picture filter form base class.
 *
 * @package    filters
 * @subpackage Picture *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePictureFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'still'      => new sfWidgetFormFilterInput(),
      'resolution' => new sfWidgetFormFilterInput(),
      'quality'    => new sfWidgetFormFilterInput(),
      'format'     => new sfWidgetFormFilterInput(),
      'storage_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Storage', 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'still'      => new sfValidatorPass(array('required' => false)),
      'resolution' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quality'    => new sfValidatorPass(array('required' => false)),
      'format'     => new sfValidatorPass(array('required' => false)),
      'storage_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Storage', 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('picture_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Picture';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'still'      => 'Text',
      'resolution' => 'Number',
      'quality'    => 'Text',
      'format'     => 'Text',
      'storage_id' => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}