<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseGPS extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('g_p_s');
    }

    public function setUp()
    {
        $this->hasOne('Satellites', array('local' => 'id',
                                          'foreign' => 'g_p_s_id'));

        $this->hasOne('Position', array('local' => 'id',
                                        'foreign' => 'g_p_s_id'));

        $this->hasOne('Course', array('local' => 'id',
                                      'foreign' => 'g_p_s_id'));
    }
}