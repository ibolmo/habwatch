<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Email filter form base class.
 *
 * @package    filters
 * @subpackage Email *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseEmailFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'              => new sfWidgetFormFilterInput(),
      'sf_guard_user_id'  => new sfWidgetFormDoctrineChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'campaign_id'       => new sfWidgetFormFilterInput(),
      'from'             => new sfWidgetFormFilterInput(),
      'to'               => new sfWidgetFormFilterInput(),
      'carbon_copy'       => new sfWidgetFormFilterInput(),
      'blind_carbon_copy' => new sfWidgetFormFilterInput(),
      'message'           => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'              => new sfValidatorPass(array('required' => false)),
      'sf_guard_user_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'campaign_id'       => new sfValidatorInteger(array('required' => false)),
      'from'             => new sfValidatorPass(array('required' => false)),
      'to'               => new sfValidatorPass(array('required' => false)),
      'carbon_copy'       => new sfValidatorPass(array('required' => false)),
      'blind_carbon_copy' => new sfValidatorPass(array('required' => false)),
      'message'           => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('email_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Email';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'file'              => 'Text',
      'sf_guard_user_id'  => 'ForeignKey',
      'campaign_id'       => 'Number',
      'from'              => 'Text',
      'to'                => 'Text',
      'carbon_copy'       => 'Text',
      'blind_carbon_copy' => 'Text',
      'message'           => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}