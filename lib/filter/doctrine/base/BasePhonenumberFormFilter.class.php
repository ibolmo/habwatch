<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * PhoneNumber filter form base class.
 *
 * @package    filters
 * @subpackage PhoneNumber *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BasePhoneNumberFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'     => new sfWidgetFormFilterInput(),
      'profile_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Profile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'number'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'profile_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Profile', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('phone_number_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PhoneNumber';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'number'     => 'Number',
      'profile_id' => 'ForeignKey',
    );
  }
}