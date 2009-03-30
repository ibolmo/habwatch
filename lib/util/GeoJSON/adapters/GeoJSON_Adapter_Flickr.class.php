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
		return $location ? "POINT({$location['longitude']},{$location['latitude']})" : null;
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
	    $location = $object->getLocation();
	    
		return array_merge(array(
		    'id' => $object->getId(),
		    'server' => $object->getServer(),
		    'license' => $object->getLicense(),
		    'owner_id' => $object->getUserId(),
		    'title' => $object->getTitle(),
		    'description' => $object->getDescription(),
		    'isfamily' => , $object->isForFamily(),
		    'ispublic' => $object->isForPublic(),
		    'isfriend' => $object->isForFriends(),
		    'posted_timestamp' => $object->getPostedTimestamp(),
		    'taken_timestamp' => $object->getTakenTimestamp(),
		    'tags' => implode(' ', $object->getTags()),
		    'accuracy' => false,
		    'place_id' => false,
		    'woeid' => false,
		    'img_url' => $object->buildImgUrl(),
		    'farm' => $object->getFarm(),
    		'rating' => $object->getRating()
		), $location ? array(
		    'accuracy' => $location['accuracy'],
		    'place_id' => $location['place_id'],
		    'woeid' => $location['woeid']
        ) : array());
	}

}
