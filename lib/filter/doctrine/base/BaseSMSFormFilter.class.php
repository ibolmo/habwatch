<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * SMS filter form base class.
 *
 * @package    filters
 * @subpackage SMS *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseSMSFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'file'              => new sfWidgetFormFilterInput(),
      'from'              => new sfWidgetFormFilterInput(),
      'to'                => new sfWidgetFormFilterInput(),
      'message'           => new sfWidgetFormFilterInput(),
      'storage_id'        => new sfWidgetFormDoctrineChoice(array('model' => 'Storage', 'add_empty' => true)),
      'type'              => new sfWidgetFormFilterInput(),
      'carbon_copy'       => new sfWidgetFormFilterInput(),
      'blind_carbon_copy' => new sfWidgetFormFilterInput(),
      'subject'           => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'file'              => new sfValidatorPass(array('required' => false)),
      'from'              => new sfValidatorPass(array('required' => false)),
      'to'                => new sfValidatorPass(array('required' => false)),
      'message'           => new sfValidatorPass(array('required' => false)),
      'storage_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Storage', 'column' => 'id')),
      'type'              => new sfValidatorPass(array('required' => false)),
      'carbon_copy'       => new sfValidatorPass(array('required' => false)),
      'blind_carbon_copy' => new sfValidatorPass(array('required' => false)),
      'subject'           => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sms_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SMS';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'file'              => 'Text',
      'from'              => 'Text',
      'to'                => 'Text',
      'message'           => 'Text',
      'storage_id'        => 'ForeignKey',
      'type'              => 'Text',
      'carbon_copy'       => 'Text',
      'blind_carbon_copy' => 'Text',
      'subject'           => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}