<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseReport extends Datum
{
  public function setTableDefinition()
  {
    parent::setTableDefinition();
    $this->setTableName('report');
    $this->hasColumn('quantity', 'integer', null, array('type' => 'integer'));
    $this->hasColumn('condition', 'string', null, array('type' => 'string'));
    $this->hasColumn('subject', 'string', null, array('type' => 'string'));
    $this->hasColumn('location', 'string', null, array('type' => 'string'));
    $this->hasColumn('message_id', 'integer', null, array('type' => 'integer'));
    $this->hasColumn('storage_id', 'integer', null, array('type' => 'integer'));
  }

  public function setUp()
  {
    parent::setUp();
    $this->hasOne('Message', array('local' => 'message_id',
                                   'foreign' => 'id'));

    $this->hasOne('Storage', array('local' => 'storage_id',
                                   'foreign' => 'id',
                                   'onDelete' => 'CASCADE'));

    $this->hasOne('Coordinate as Point', array('local' => 'id',
                                               'foreign' => 'report_id'));
  }
}