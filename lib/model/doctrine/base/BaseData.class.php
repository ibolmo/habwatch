<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseData extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('data');
    $this->hasColumn('sf_guard_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
  }

  public function setUp()
  {
    $this->hasOne('sfGuardUser', array('local' => 'sf_guard_user_id',
                                       'foreign' => 'id',
                                       'onDelete' => 'CASCADE'));

    $this->hasMany('Picture as Pictures', array('local' => 'id',
                                                'foreign' => 'data_id'));

    $this->hasMany('Satellites', array('local' => 'id',
                                       'foreign' => 'data_id'));

    $this->hasMany('Position as Positions', array('local' => 'id',
                                                  'foreign' => 'data_id'));

    $this->hasMany('Course as Courses', array('local' => 'id',
                                              'foreign' => 'data_id'));

    $this->hasMany('Message as Messages', array('local' => 'id',
                                                'foreign' => 'data_id'));

    $this->hasMany('SMS', array('local' => 'id',
                                'foreign' => 'data_id'));

    $this->hasMany('Email as Emails', array('local' => 'id',
                                            'foreign' => 'data_id'));
  }
}