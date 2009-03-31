<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$t = $browser->test();

$t->diag('Check classes exist');
$t->ok(class_exists('GeoJSON'), 'Correctly loaded GeoJSON');
$t->ok(class_exists('Flickr'), 'Correctly loaded Flickr');

$t->diag('Load Flickr Objects');
$t->ok($PhotoList = Flickr::getUser()->getPhotoListWithGeoData(2), 'PhotoList loaded');
$t->ok($Photo = Flickr::getPhoto(3307431270), 'Photo loaded');

$t->diag('Instantiate Flickr Adapter');
$t->ok($Flickr_Adapter = new GeoJSON_Flickr_Adapter(), 'Flickr Adapter initiated');

$t->diag('Check loadFrom Flickr_Photo');
$Feature = GeoJSON::loadFrom($Photo, $Flickr_Adapter);
$t->isa_ok($Feature, Feature, 'Flickr_Photo becomes a Feature');

$t->diag('Check loadFrom Flickr_PhotoList');
$FeatureCollection = GeoJSON::loadFrom($PhotoList, $Flickr_Adapter);
$t->isa_ok($FeatureCollection, FeatureCollection, 'Flickr_PhotoList becomes a FeatureCollection');

//*
var_dump(array(
    'message' => GeoJSON::dump($FeatureCollection)
));
//*/