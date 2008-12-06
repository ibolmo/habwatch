<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseEmail extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('email');
    $this->hasColumn('address', 'string', 100, array('type' => 'string', 'length' => 100, 'unique' => true));
    $this->hasColumn('profile_id', 'integer', null, array('type' => 'integer'));
  }

  public function setUp()
  {
    $this->hasOne('Profile', array('local' => 'profile_id',
                                   'foreign' => 'id',
                                   'onDelete' => 'CASCADE'));
  }
}