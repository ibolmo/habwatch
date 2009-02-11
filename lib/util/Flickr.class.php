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
}
