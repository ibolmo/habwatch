<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Course filter form base class.
 *
 * @package    filters
 * @subpackage Course *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseCourseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'             => new sfWidgetFormFilterInput(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'campaign_id'      => new sfWidgetFormFilterInput(),
      'speed'            => new sfWidgetFormFilterInput(),
      'heading'          => new sfWidgetFormFilterInput(),
      'heading_accuracy' => new sfWidgetFormFilterInput(),
      'speed_accuracy'   => new sfWidgetFormFilterInput(),
      'g_p_s_id'         => new sfWidgetFormDoctrineChoice(array('model' => 'GPS', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'             => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'campaign_id'      => new sfValidatorInteger(array('required' => false)),
      'speed'            => new sfValidatorNumber(array('required' => false)),
      'heading'          => new sfValidatorNumber(array('required' => false)),
      'heading_accuracy' => new sfValidatorNumber(array('required' => false)),
      'speed_accuracy'   => new sfValidatorNumber(array('required' => false)),
      'g_p_s_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'GPS', 'column' => 'id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('course_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Course';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'file'             => 'Text',
      'sf_guard_user_id' => 'ForeignKey',
      'campaign_id'      => 'Number',
      'speed'            => 'Number',
      'heading'          => 'Number',
      'heading_accuracy' => 'Number',
      'speed_accuracy'   => 'Number',
      'g_p_s_id'         => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}