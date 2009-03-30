<?php

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
        $Pager = new sfFlickrPager(new Flickr_PhotoList($request, $count));
        $Pager->setPage($page);
        $Pager->init();
        return $Pager;
    }
    
    public static function getPhoto($photo_id)
    {
        return new Flickr_Photo(self::getUser()->getApi(), $photo_id);
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

class Flickr_PhotoList extends Phlickr_PhotoList
{
    public function getPhotosFromPage($page, $allowCached = true) {
        if ($allowCached) {
            $this->load($page);
        } else {
            $this->refresh($page);
        }

        $ret = array();
        foreach ($this->_cachedXml[$page]->{self::getResponseElement()} as $xmlPhoto) {
            if ($xmlPhoto['owner'] == $this->getApi()->getUserId()) {
                $ret[] = new Flickr_AuthedPhoto($this->getApi(), $xmlPhoto);
            } else {
                $ret[] = new Flickr_Photo($this->getApi(), $xmlPhoto);
            }
        }
        return $ret;
    }
}

class Flickr_Photo extends Phlickr_Photo
{
    protected $Rating, $machine_tags;
    
    public function getRating()
    {
        if (!$this->Rating) $this->Rating = new Flickr_Photo_Rating($this);
        return $this->Rating;
    }
    
    public function getLicense()
    {
        return (integer) $this->_cachedXml['license'];
    }
    
    public function getLocation()
    {
        if (!isset($this->_cachedXml->location)) return false;
        return $this->_cachedXml->location;
    }
    
    public function hasTag($tag)
    {
        return in_array($tag, $this->getTags());
    }
    
    public function getMachineTag($name, $pred, $default = 1)
    {
        if (!$this->machine_tags) {
            $raw_machine_tags = array_filter($this->getTags(), create_function('$tag', 'return strpos($tag, \':\') !== false;'));
            $this->machine_tags = array();
            foreach ($raw_machine_tags as $tag) {
                preg_match('/^(?P<namespace>[\w]*):(?P<predicate>[\w]*)=[\'\"]?(?P<value>[\w]*)[\'\"]?$/', $tag, $matches);
                list($namespace, $predicate, $value) = array($matches['namespace'], $matches['predicate'], $matches['value']);
                
                if (!array_key_exists($namespace, $this->machine_tags)) $this->machine_tags[$namespace] = array();
                $this->machine_tags[$namespace][$predicate] = $value;
            }
        }
        return @$this->machine_tags[$name][$pred];
    }
}


class Flickr_AuthedPhoto extends Flickr_Photo
{
}

class Flickr_Photo_Rating
{
    
    function __construct(Flickr_Photo $Photo)
    {
        $this->Photo = $Photo;
        $this->value = (integer) $Photo->getMachineTag('habwatch', 'rating');
    }
    
    public function set($to = 0)
    {
        try {
            $this->Photo->removeTag('habwatch:rating='.$this->value);
        } catch (Exception $e){}
        
        $this->Photo->addTags(array('habwatch:rating='.$to));
        $this->value = $to;
    }
    
    public function getPercent()
    {
        return round($this->value * 20).'%';
    }
    
    public function getStars()
    {
        return array(
            '<li><a href="#" title="1 star out of 5" class="one-star">1</a></li>',
            '<li><a href="#" title="2 stars out of 5" class="two-stars">2</a></li>',
            '<li><a href="#" title="3 stars out of 5" class="three-stars">3</a></li>',
            '<li><a href="#" title="4 stars out of 5" class="four-stars">4</a></li>',
            '<li><a href="#" title="5 stars out of 5" class="five-stars">5</a></li>'
        );
    }
}

