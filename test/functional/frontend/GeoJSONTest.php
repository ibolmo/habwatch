<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$t = $browser->test();

$t->diag('Check classes exist');
$t->ok(class_exists('GeoJSON'), 'Correctly loaded GeoJSON');
$t->ok(class_exists('Flickr'), 'Correctly loaded Flickr');

$t->diag('Load Flickr Objects');
$t->ok($PhotoList = Flickr::getUser()->getPhotoList(2), 'PhotoList loaded');
$t->ok($Photo = current(Flickr::getRecentPhotos(1)), 'Photo loaded');

$t->diag('Instantiate Flickr Adapter');
$t->ok($Flickr_Adapter = new GeoJSON_Flickr_Adapter(), 'Flickr Adapter initiated');

$t->diag('Check loadFrom Flickr_Photo');
$Feature = GeoJSON::loadFrom($Photo, $Flickr_Adapter);
$t->isa_ok($Feature, Feature);
