<?php

class Flickr_PhotoList extends Phlickr_PhotoList
{
    private $_page = 1;
    
    public function __construct(Phlickr_Request $request, $photosPerPage = self::PER_PAGE_DEFAULT, $useCache = true)
    {
        $this->_request = $request;
        // API limits the number of photos per page
        $this->_perPage = ($photosPerPage > self::PER_PAGE_MAX) ? self::PER_PAGE_MAX : (integer) $photosPerPage;
        $this->load(null, $useCache);
    }
    
    public function load($page = null, $useCache = true) {
        $page = (is_null($page)) ? $this->getPage() : (integer) $page ;
        $this->_cachedXml[$page] = $this->requestXml($useCache, $page);
    }
    
    public function getPhotosFromPage($page, $allowCached = true) {
        if ($allowCached) {
            $this->load($page);
        } else {
            $this->refresh($page);
        }

        $ret = array();
        foreach ($this->_cachedXml[$page]->{self::getResponseElement()} as $xmlPhoto) {
            $class = ($xmlPhoto['owner'] == $this->getApi()->getUserId()) ? 'Flickr_AuthedPhoto' : 'Flickr_Photo';
            $ret[] = $photo = new $class($this->getApi(), $xmlPhoto);
            $photo->load();
        }
        return $ret;
    }
    
    public function getPhotos($useCache = true) {
        return $this->getPhotosFromPage($this->_page, $useCache);
    }
}