<?php

/**
* 
*/
class Flickr extends Phlickr_Api
{
    static protected 
        $instance,
        $user, 
        $hidden_tags = array('useful', 'olmomaldonado'),
        $ungeotagged_tags = array(),
        $hidden_tags_pattern = "/^[0-9]+$/";
    
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
            self::$user = new Flickr_AuthedUser(self::getInstance());
        }
        return self::$user;
    }
    
    public static function hasPhotos()
    {
        return !!self::getUser()->getPhotoCount();
    }
    
    public static function getPopularTags($limit = null, $filter = false)
    {
        if ($limit == null || $limit < 0) $limit = 10;
        
        $Tags = self::getUser()->getPopularTags($limit * 2); # Just in case we filter too many
        if ($filter) $Tags = array_filter($Tags, 'Flickr::isTagPublic');
        return array_slice($Tags, 0, $limit);
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
    
    public static function isTagPublic($tag, $strict = false)
    {
        if (in_array($tag, self::$hidden_tags, $strict) || preg_match(self::$hidden_tags_pattern, $tag)) return false;
        
        if (!count(self::$ungeotagged_tags)){
            $ungeotagged_photo_list = self::getUser()->getPhotoListWithoutGeoData();
            foreach ($ungeotagged_photo_list->getPhotos() as $Photo) {
                self::$ungeotagged_tags = array_keys(array_flip(self::$ungeotagged_tags) + array_flip($Photo->getTags()));
            }
        }
        
        return !in_array($tag, self::$ungeotagged_tags, $strict);
    }
}

/**
* 
*/
class Flickr_AuthedUser extends Phlickr_AuthedUser
{
    public function getPhotoListWithoutGeoData($perPage = Phlickr_PhotoList::PER_PAGE_DEFAULT) {
        $request = $this->getApi()->createRequest(
            'flickr.photos.getWithoutGeoData', array(
                'user_id' => $this->getId(),
                'extras' => 'tags'
            )
        );
        return new Phlickr_PhotoList($request, $perPage);
    }
}
