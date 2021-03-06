<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseCoordinate extends Datum
{
    public function setTableDefinition()
    {
        parent::setTableDefinition();
        $this->setTableName('coordinate');
        $this->hasColumn('latitude', 'string', null, array('type' => 'string'));
        $this->hasColumn('longitude', 'string', null, array('type' => 'string'));
        $this->hasColumn('report_id', 'integer', null, array('type' => 'integer'));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Report', array('local' => 'report_id',
                                      'foreign' => 'id',
                                      'onDelete' => 'CASCADE'));
    }
}