<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseMessage extends Datum
{
  public function setTableDefinition()
  {
    parent::setTableDefinition();
    $this->setTableName('message');
    $this->hasColumn('_from as from', 'string', 125, array('type' => 'string', 'length' => 125, 'nospace' => true));
    $this->hasColumn('_to as to', 'string', 125, array('type' => 'string', 'length' => 125, 'nospace' => true));
    $this->hasColumn('message', 'string', null, array('type' => 'string'));
    $this->hasColumn('data_id', 'integer', null, array('type' => 'integer'));
    $this->hasColumn('type', 'string', 255, array('type' => 'string', 'length' => 255));
    $this->hasColumn('carbon_copy', 'string', null, array('type' => 'string', 'nospace' => true));
    $this->hasColumn('blind_carbon_copy', 'string', null, array('type' => 'string', 'nospace' => true));
    $this->hasColumn('subject', 'string', null, array('type' => 'string'));

    $this->setSubClasses(array('SMS' => array('type' => 'SMS'), 'Email' => array('type' => 'Email')));
  }

  public function setUp()
  {
    parent::setUp();
    $this->hasOne('Data', array('local' => 'data_id',
                                'foreign' => 'id',
                                'onDelete' => 'CASCADE'));
  }
}