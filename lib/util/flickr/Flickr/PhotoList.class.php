<?php

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
            $class = ($xmlPhoto['owner'] == $this->getApi()->getUserId()) ? 'Flickr_AuthedPhoto' : 'Flickr_Photo';
            $ret[] = $photo = new $class($this->getApi(), $xmlPhoto);
            $photo->load();
        }
        return $ret;
    }
}