<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasesfGuardGroupPermission extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_group_permission');
        $this->hasColumn('group_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
        $this->hasColumn('permission_id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'length' => '4'));
    }

    public function setUp()
    {
        $this->hasOne('sfGuardGroup', array('local' => 'group_id',
                                            'foreign' => 'id',
                                            'onDelete' => 'CASCADE'));

        $this->hasOne('sfGuardPermission', array('local' => 'permission_id',
                                                 'foreign' => 'id',
                                                 'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}