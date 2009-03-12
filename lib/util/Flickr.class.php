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
            self::$instance->setCacheFilename(sfConfig::get('app_flickr_cache_dir'));
            self::$instance->setCache(Phlickr_Cache::createFrom(sfConfig::get('app_flickr_cache_dir')));
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
    
    public static function getPager($page = 0, $count = 5)
    {
        $request = self::getUser()->getApi()->createRequest('flickr.photos.search', array(
            'user_id' => self::getUser()->getId()
        ));
        $Pager = new sfFlickrPager(new Phlickr_PhotoList($request, $count));
        $Pager->setPage($page);
        $Pager->init();
        return $Pager;
    }
    
    public static function getPhoto($photo_id)
    {
        return new Phlickr_Photo(self::getUser()->getApi(), $photo_id);
    }
}

class sfFlickrPager extends sfPager
{
    public function init()
    {
        $this->setNbResults($this->class->getCount());
        $this->setMaxRecordLimit(Phlickr_PhotoList::PER_PAGE_MAX);
        $this->setLastPage($this->class->getPageCount() - 1);
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


