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
      'still'             => new sfWidgetFormFilterInput(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'campaign_id'      => new sfWidgetFormFilterInput(),
      'resolution'       => new sfWidgetFormFilterInput(),
      'quality'          => new sfWidgetFormFilterInput(),
      'format'           => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'still'             => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'campaign_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'resolution'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quality'          => new sfValidatorPass(array('required' => false)),
      'format'           => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'id'               => 'Number',
      'still'            => 'Text',
      'sf_guard_user_id' => 'ForeignKey',
      'campaign_id'      => 'Number',
      'resolution'       => 'Number',
      'quality'          => 'Text',
      'format'           => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}