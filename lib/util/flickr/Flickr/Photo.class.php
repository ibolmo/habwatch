<?php

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