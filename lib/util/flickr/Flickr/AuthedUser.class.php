<?php

class Flickr_AuthedUser extends Phlickr_AuthedUser
{
    public function getPhotoListWithoutGeoData($perPage = Phlickr_PhotoList::PER_PAGE_DEFAULT) {
        $request = $this->getApi()->createRequest(
            'flickr.photos.getWithoutGeoData', array(
                'user_id' => $this->getId(),
                'extras' => 'tags'
            )
        );
        return new Flickr_PhotoList($request, $perPage);
    }
    
    public function getPhotoList($perPage = Phlickr_PhotoList::PER_PAGE_DEFAULT) {
        $request = $this->getApi()->createRequest('flickr.photos.search',
            array('user_id'=>$this->getId())
        );
        return new Flickr_PhotoList($request, $perPage);
    }
}