<?php

/**
 * flickr actions.
 *
 * @package    habwatch
 * @subpackage flickr
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class flickrActions extends sfActions
{
	public function executeGeojson(sfWebRequest $request)
	{
		$User = Flickr::getUser();
		$count = $User->getPhotoCount();
		$Photos = array();
		for ($i = 0; $i < $count; $i += Flickr_PhotoList::PER_PAGE_MAX) { 
			$Photos[] = $User->getPhotoListWithGeoData(Flickr_PhotoList::PER_PAGE_MAX);
		}
		
		$Adapter = new GeoJSON_Flickr_Adapter();
		$result = GeoJSON::loadFrom(array_shift($Photos), $Adapter)->getGeoInterface();
		foreach ($Photos as $PhotoList) {
			$collection = GeoJSON::loadFrom($PhotoList, $Adapter)->getGeoInterface();
			$result['features'] = array_merge($result['features'], $collection['features']);
		}
		
		$this->json = json_encode($result);
	}
}
