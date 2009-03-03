<?php

/**
* 
*/
class Flickr extends Phlickr_Api
{
    static protected $instance;
    static protected $user;
    
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Flickr(sfConfig::get('app_flickr_api_key'), sfConfig::get('app_flickr_secret'), sfConfig::get('app_flickr_token'));
        }
        return self::$instance;
    }
    
    public static function getUser()
    {
        if (!isset(self::$user)) {
            self::$user = new Phlickr_AuthedUser(self::getInstance());
        }
        return self::$user;
    }
    
    public static function hasPhotos()
    {
        return !!self::getUser()->getPhotoCount();
    }
    
    public static function getPopularTags()
    {
        return self::getUser()->getPopularTags();
    }
    
    public static function getRecentPhotos($count = 5)
    {        
        $PhotoList = self::getUser()->getPhotoList($count);
        return $PhotoList->getPhotos();
    }
    
    /**
     * Phlickr, loads page 1 by default. Not good.
     */
    public static function getPager($page = 0, $count = 5)
    {
        $request = self::getUser()->getApi()->createRequest('flickr.photos.search', array(
            'user_id' => self::getUser()->getId()
        ));
        $Pager = new sfFlickrPager(new Phlickr_PhotoList($request, $count));
        $Pager->setPage($page);
        return $Pager;
    }
}

class sfFlickrPager extends sfPager
{
    public function init()
    {
        $this->setNbResults($this->class->getCount());
        $this->setMaxRecordLimit(Phlickr_PhotoList::PER_PAGE_MAX);
        
        if ($this->getPage() == 0 || $this->getMaxPerPage() == 0 || $this->getNbResults() == 0) {
            $this->setLastPage(0);
        } else {
            $offset = ($this->getPage() - 1) * $this->getMaxPerPage();
            $this->setLastPage(ceil($this->getNbResults() / $this->getMaxPerPage()));
        }
    }
    
    public function getResults()
    {
        return $this->class->getPhotos();
    }
    
    public function setPage($page)
    {
        parent::setPage($page);
        $this->class->setPage($page);
    }
    
    protected function retrieveObject($offset)
    {
        $results = $this->getResults();
        return $results[$offset];
    }
}


