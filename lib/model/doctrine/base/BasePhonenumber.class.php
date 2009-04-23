<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasePhoneNumber extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('phone_number');
        $this->hasColumn('number', 'string', 14, array('type' => 'string', 'length' => 14, 'notnull' => true, 'nospace' => true));
        $this->hasColumn('disabled', 'boolean', null, array('type' => 'boolean', 'default' => false));
        $this->hasColumn('profile_id', 'integer', null, array('type' => 'integer'));
    }

    public function setUp()
    {
        $this->hasOne('Profile', array('local' => 'profile_id',
                                       'foreign' => 'id',
                                       'onDelete' => 'CASCADE'));
    }
}