<?php

class Flickr_AuthedUser extends Phlickr_AuthedUser
{
    public function getPhotoListWithoutGeoData($perPage = Phlickr_PhotoList::PER_PAGE_DEFAULT) {
        $request = $this->getApi()->createRequest('flickr.photos.getWithoutGeoData', array(
            'user_id' => $this->getId(),
            'extras' => 'tags'
        ));
        return new Flickr_PhotoList($request, $perPage);
    }
    
    public function getPhotoListWithGeoData($perPage = Phlickr_PhotoList::PER_PAGE_DEFAULT, $useCache = true) {
        $request = $this->getApi()->createRequest('flickr.photos.getWithGeoData', array(
            'user_id' => $this->getId(),
        ));
        return new Flickr_PhotoList($request, $perPage, $useCache);
    }
    
    public function getPhotoList($perPage = Phlickr_PhotoList::PER_PAGE_DEFAULT, $useCache = true) {
        $request = $this->getApi()->createRequest('flickr.people.getPublicPhotos', array(
            'user_id' => $this->getId()
        ));
        
        return new Flickr_PhotoList($request, $perPage, $useCache);
    }
}