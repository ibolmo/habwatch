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
    $this->hasColumn('sf_guard_user_id', 'integer', 4, array('type' => 'integer', 'length' => '4'));
    $this->hasColumn('campaign_id', 'integer', null, array('type' => 'integer'));
  }

  public function setUp()
  {
    $this->hasOne('sfGuardUser', array('local' => 'sf_guard_user_id',
                                       'foreign' => 'id',
                                       'onDelete' => 'CASCADE',
                                       'owningSide' => true));

    $timestampable0 = new Doctrine_Template_Timestampable();
    $this->actAs($timestampable0);
  }
}