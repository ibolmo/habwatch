<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * EmailAddress filter form base class.
 *
 * @package    filters
 * @subpackage EmailAddress *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseEmailAddressFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'address'    => new sfWidgetFormFilterInput(),
      'profile_id' => new sfWidgetFormDoctrineChoice(array('model' => 'Profile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'address'    => new sfValidatorPass(array('required' => false)),
      'profile_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Profile', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('email_address_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailAddress';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'address'    => 'Text',
      'profile_id' => 'ForeignKey',
    );
  }
}