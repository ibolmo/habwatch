<?php

class GMap
{
    public static $uri = 'http://maps.google.com/maps/geo';
    public static $browser;
    
    public static function geocode($search, $parameters = array())
    {
        if (!self::$browser) self::$browser = new sfWebBrowser();
        
        self::$browser->get(self::$uri, array_merge(array(
            'q' => $search,
            'key' => sfConfig::get('app_google_maps_key'),
            'sensor' => 'false',
            'output' => 'json',
            'oe' => 'utf8',
            'gl' => 'us'
        ), $parameters));
        
        $json_string = self::$browser->getResponseText();
        return $json_string ? json_decode($json_string, true) : false;
    }
}
