<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Position filter form base class.
 *
 * @package    filters
 * @subpackage Position *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePositionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'                => new sfWidgetFormFilterInput(),
      'sf_guard_user_id'    => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'campaign_id'         => new sfWidgetFormFilterInput(),
      'latitude'            => new sfWidgetFormFilterInput(),
      'altitude'            => new sfWidgetFormFilterInput(),
      'vertical_accuracy'   => new sfWidgetFormFilterInput(),
      'longitude'           => new sfWidgetFormFilterInput(),
      'horizontal_accuracy' => new sfWidgetFormFilterInput(),
      'g_p_s_id'            => new sfWidgetFormDoctrineChoice(array('model' => 'GPS', 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'                => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'campaign_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'latitude'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'altitude'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'vertical_accuracy'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'longitude'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'horizontal_accuracy' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'g_p_s_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'GPS', 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('position_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Position';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'file'                => 'Text',
      'sf_guard_user_id'    => 'ForeignKey',
      'campaign_id'         => 'Number',
      'latitude'            => 'Number',
      'altitude'            => 'Number',
      'vertical_accuracy'   => 'Number',
      'longitude'           => 'Number',
      'horizontal_accuracy' => 'Number',
      'g_p_s_id'            => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}