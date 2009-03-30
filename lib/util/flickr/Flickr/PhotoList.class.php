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
            if ($xmlPhoto['owner'] == $this->getApi()->getUserId()) {
                $ret[] = new Flickr_AuthedPhoto($this->getApi(), $xmlPhoto);
            } else {
                $ret[] = new Flickr_Photo($this->getApi(), $xmlPhoto);
            }
        }
        return $ret;
    }
}