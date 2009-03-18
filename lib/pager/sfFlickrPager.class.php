<?php
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


