<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseSatellites extends Datum
{
  public function setTableDefinition()
  {
    parent::setTableDefinition();
    $this->setTableName('satellites');
    $this->hasColumn('horizontal_dop', 'float', null, array('type' => 'float'));
    $this->hasColumn('used_satellites', 'integer', 10, array('type' => 'integer', 'length' => 10));
    $this->hasColumn('vertical_dop', 'float', null, array('type' => 'float'));
    $this->hasColumn('time', 'float', null, array('type' => 'float'));
    $this->hasColumn('satellites', 'integer', 10, array('type' => 'integer', 'length' => 10));
    $this->hasColumn('time_dop', 'float', null, array('type' => 'float'));
    $this->hasColumn('g_p_s_id', 'integer', null, array('type' => 'integer'));
  }

  public function setUp()
  {
    parent::setUp();
    $this->hasOne('GPS', array('local' => 'g_p_s_id',
                               'foreign' => 'id',
                               'owningSide' => true));
  }
}