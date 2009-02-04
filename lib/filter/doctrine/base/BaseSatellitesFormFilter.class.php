<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Satellites filter form base class.
 *
 * @package    filters
 * @subpackage Satellites *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseSatellitesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'             => new sfWidgetFormFilterInput(),
      'sf_guard_user_id' => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'horizontal_dop'   => new sfWidgetFormFilterInput(),
      'used_satellites'  => new sfWidgetFormFilterInput(),
      'vertical_dop'     => new sfWidgetFormFilterInput(),
      'time'             => new sfWidgetFormFilterInput(),
      'satellites'       => new sfWidgetFormFilterInput(),
      'time_dop'         => new sfWidgetFormFilterInput(),
      'g_p_s_id'         => new sfWidgetFormDoctrineChoice(array('model' => 'GPS', 'add_empty' => true)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'             => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'horizontal_dop'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'used_satellites'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vertical_dop'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'time'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'satellites'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'time_dop'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'g_p_s_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'GPS', 'column' => 'id')),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('satellites_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Satellites';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'file'             => 'Text',
      'sf_guard_user_id' => 'ForeignKey',
      'horizontal_dop'   => 'Number',
      'used_satellites'  => 'Number',
      'vertical_dop'     => 'Number',
      'time'             => 'Number',
      'satellites'       => 'Number',
      'time_dop'         => 'Number',
      'g_p_s_id'         => 'ForeignKey',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}