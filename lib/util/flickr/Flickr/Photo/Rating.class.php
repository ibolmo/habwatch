<?php

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
    
    public function __toString()
    {
        return (string) $this->value;
    }
}
