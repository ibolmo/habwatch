<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseDatum extends sfDoctrineRecord
{
  public function setTableDefinition()
  {
    $this->setTableName('datum');
    $this->hasColumn('file', 'blob', null, array('type' => 'blob'));
  }

  public function setUp()
  {
    $this->hasOne('Preference', array('local' => 'id',
                                      'foreign' => 'datum_id'));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $this->actAs($timestampable0);
  }
}