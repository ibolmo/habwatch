<?php

/**
 * Flickr adapter to load Doctrine_Collection or Doctrine_Record 
 *	in FeatureCollection or Feature
 */
class GeoJSON_Flickr_Adapter implements GeoJSON_Adapter
{

	/**
	 * Returns object properties
	 *
	 * @param Flickr_Photolist|Flickr_Photo $object
	 *
	 * @return boolean
	 */
	public function isMultiple($object)
	{
		return $object instanceof Flickr_PhotoList;
	}

	/**
	 * Returns an iterable object of features
	 *
	 * @param Flickr_PhotoList $object
	 *
	 * @return Flickr_PhotoList
	 */
	public function getIterable($object)
	{
		return $object->getPhotos();
	}

	/**
	 * Returns object geometry
	 *
	 * @param Flickr_Photo $object
	 *
	 * @return string The geometry in WKT
	 */
	public function getObjectGeometry($object)
	{
		$location = $object->getLocation();
		if (!$location) throw new Exception("Flickr Object does not have a location");
		return "POINT({$location['longitude']} {$location['latitude']})";
	}

	/**
	 * Returns object id
	 *
	 * @param Flickr_Photo $object
	 *
	 * @return mixed
	 */
	public function getObjectId($object)
	{
		return $object->getId();
	}

	/**
	 * Returns object properties
	 *
	 * @param Flickr_Photo $object
	 *
	 * @return array
	 */
	public function getObjectProperties($object)
	{
	    return $object->getInfo();
	}

}
