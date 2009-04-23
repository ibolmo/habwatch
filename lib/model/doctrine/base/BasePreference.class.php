<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BasePreference extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('preference');
        $this->hasColumn('enabled', 'boolean', null, array('type' => 'boolean', 'default' => false));
        $this->hasColumn('datum_id', 'integer', null, array('type' => 'integer'));
    }

    public function setUp()
    {
        $this->hasOne('Datum', array('local' => 'datum_id',
                                     'foreign' => 'id',
                                     'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}