<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseProfile extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('profile');
    $this->hasColumn('first_name', 'string', 128, array('type' => 'string', 'length' => 128, 'notnull' => true));
    $this->hasColumn('middle_name', 'string', 100, array('type' => 'string', 'length' => 100));
    $this->hasColumn('last_name', 'string', 100, array('type' => 'string', 'length' => 100, 'notnull' => true));
    $this->hasColumn('sf_guard_user_id', 'integer', 4, array('type' => 'integer', 'length' => 4, 'notnull' => true));
  }

  public function setUp()
  {
    $this->hasOne('sfGuardUser as User', array('local' => 'sf_guard_user_id',
                                               'foreign' => 'id',
                                               'onDelete' => 'CASCADE'));

    $this->hasMany('EmailAddress as Emails', array('local' => 'id',
                                                   'foreign' => 'profile_id'));

    $this->hasMany('PhoneNumber as Phones', array('local' => 'id',
                                                  'foreign' => 'profile_id'));
  }
}