<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasesfGuardUser extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user');
        $this->hasColumn('id', 'integer', 4, array('type' => 'integer', 'primary' => true, 'autoincrement' => true, 'length' => '4'));
        $this->hasColumn('username', 'string', 128, array('type' => 'string', 'notnull' => true, 'unique' => true, 'length' => '128'));
        $this->hasColumn('algorithm', 'string', 128, array('type' => 'string', 'default' => 'sha1', 'notnull' => true, 'length' => '128'));
        $this->hasColumn('salt', 'string', 128, array('type' => 'string', 'length' => '128'));
        $this->hasColumn('password', 'string', 128, array('type' => 'string', 'length' => '128'));
        $this->hasColumn('is_active', 'boolean', null, array('type' => 'boolean', 'default' => '1'));
        $this->hasColumn('is_super_admin', 'boolean', null, array('type' => 'boolean', 'default' => false));
        $this->hasColumn('last_login', 'timestamp', null, array('type' => 'timestamp'));


        $this->index('is_active_idx', array('fields' => array(0 => 'is_active')));
    }

    public function setUp()
    {
        $this->hasMany('sfGuardGroup as groups', array('refClass' => 'sfGuardUserGroup',
                                                       'local' => 'user_id',
                                                       'foreign' => 'group_id'));

        $this->hasMany('sfGuardPermission as permissions', array('refClass' => 'sfGuardUserPermission',
                                                                 'local' => 'user_id',
                                                                 'foreign' => 'permission_id'));

        $this->hasMany('sfGuardUserPermission', array('local' => 'id',
                                                      'foreign' => 'user_id'));

        $this->hasMany('sfGuardUserGroup', array('local' => 'id',
                                                 'foreign' => 'user_id'));

        $this->hasOne('sfGuardRememberKey as RememberKeys', array('local' => 'id',
                                                                  'foreign' => 'user_id'));

        $this->hasOne('Profile', array('local' => 'id',
                                       'foreign' => 'sf_guard_user_id'));

        $this->hasOne('Storage', array('local' => 'id',
                                       'foreign' => 'sf_guard_user_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}