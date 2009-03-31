<?php

/**
 * Doctrine adapter to load Doctrine_Collection or Doctrine_Record 
 *  in FeatureCollection or Feature
 */
class GeoJSON_Doctrine_Adapter implements GeoJSON_Adapter
{

  /**
   * Returns object properties
   *
   * @param Doctrine_Record $object
   *
   * @return array
   */
  public function isMultiple($object)
  {
    return (get_class($object)==='Doctrine_Collection');
  }

  /**
   * Returns an iterable object of features
   *
   * @param Doctrine_Collection $object
   *
   * @return Doctrine_Collection
   */
  public function getIterable($object)
  {
    return $object;
  }

  /**
   * Returns object geometry
   *
   * @param Doctrine_Record $object
   *
   * @return string The geometry in WKT
   */
  public function getObjectGeometry($object)
  {
    $geometry = Doctrine::getTable(get_class($object))->getGeometryColumnName();
    return $object->$geometry;
  }

  /**
   * Returns object id
   *
   * @param Doctrine_Record $object
   *
   * @return mixed
   */
  public function getObjectId($object)
  {
    $id = Doctrine::getTable(get_class($object))->getIdentifier();
    return $object->$id;
  }

  /**
   * Returns object properties
   *
   * @param Doctrine_Record $object
   *
   * @return array
   */
  public function getObjectProperties($object)
  {
    $array = $object->toArray();
    $t = Doctrine::getTable(get_class($object));
    unset(
      $array[$t->getGeometryColumnName()],
      $array[$t->getIdentifier()]
    );
    
    return $array;
  }

}
