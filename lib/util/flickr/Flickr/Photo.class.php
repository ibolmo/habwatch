<?php

class Flickr_Photo extends Phlickr_Photo
{
    protected $Rating, $machine_tags;
    public static $machine_tag_pattern = '/(?P<namespace>[\w]*):(?P<predicate>[\w]*)=[\'\"]?(?P<value>[\w]*)[\'\"]?/';
    
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
        return isset($this->_cachedXml->location) ? $this->_cachedXml->location : false;
    }
    
    public function getRotation()
    {
        return (integer) $this->_cachedXml['rotation'];
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
                preg_match(self::$machine_tag_pattern, $tag, $matches);
                list($namespace, $predicate, $value) = array($matches['namespace'], $matches['predicate'], $matches['value']);
                
                if (!array_key_exists($namespace, $this->machine_tags)) $this->machine_tags[$namespace] = array();
                $this->machine_tags[$namespace][$predicate] = $value;
            }
        }
        return @$this->machine_tags[$name][$pred];
    }
    
    public function getInfo()
    {
        $location = $this->getLocation();
	    
		return array_merge(array(
		    'server' => $this->getServer(),
		    'license' => $this->getLicense(),
		    'owner_id' => $this->getUserId(),
		    'title' => $this->getTitle(),
		    'description' => $this->getDescription(),
		    'isfamily' => $this->isForFamily(),
		    'ispublic' => $this->isForPublic(),
		    'isfriend' => $this->isForFriends(),
		    'posted_timestamp' => $this->getPostedTimestamp(),
		    'taken_timestamp' => $this->getTakenTimestamp(),
    		'taken_date' => $this->getTakenDate(),
		    'tags' => implode(' ', $this->getTags()),
		    'accuracy' => false,
		    'place_id' => false,
		    'woeid' => false,
		    'img_url' => $this->buildImgUrl(),
		    'farm' => $this->getFarm(),
    		'rating' => $this->getRating()
		), $location ? array(
		    'accuracy' => $location['accuracy'],
		    'place_id' => $location['place_id'],
		    'woeid' => $location['woeid']
        ) : array());
    }
}