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
    public function preExecute()
    {
        sfConfig::set('sf_web_debug', false);
    }
    
	public function executeGeojson(sfWebRequest $request)
	{
		$User = Flickr::getUser();
		$count = $User->getPhotoCount();
		$amount = Flickr_PhotoList::PER_PAGE_MAX - Flickr_PhotoList::PER_PAGE_DEFAULT;
		$Photos = array($User->getPhotoListWithGeoData(Flickr_PhotoList::PER_PAGE_DEFAULT, false));
		for ($i = Flickr_PhotoList::PER_PAGE_DEFAULT; $i < $count; $i += $amount) { 
			$Photos[] = $User->getPhotoListWithGeoData($amount);
		}
		
		$Adapter = new GeoJSON_Flickr_Adapter();
		$result = GeoJSON::loadFrom(array_shift($Photos), $Adapter)->getGeoInterface();
		foreach ($Photos as $PhotoList) {
			$collection = GeoJSON::loadFrom($PhotoList, $Adapter)->getGeoInterface();
			$result['features'] = array_merge($result['features'], $collection['features']);
		}
		
		$this->json = json_encode($result);
	}

	public function executePhotoInfo(sfWebRequest $request)
	{
	    $this->forward404Unless($photo_id = $request->getParameter('photo_id'));
	    $this->forward404Unless($this->Photo = Flickr::getPhoto($photo_id));
	    $this->Info = $this->Photo->getInfo();
	    
	    $this->Info['tags'] = trim(preg_replace('/ {1}/', ' ', preg_replace(Flickr_Photo::$machine_tag_pattern, '', $this->Info['tags'])));
	    $this->Sizes = $this->Photo->getSizes();
	    $this->Size = $this->Sizes[Phlickr_Photo::SIZE_500PX];
	}
}
