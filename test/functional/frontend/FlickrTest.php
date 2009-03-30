<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());
$t = $b->test();

$api = Flickr::getInstance();

$t->diag('Check classes exist');
$t->ok(class_exists('Flickr'), 'Correctly loaded Flickr');

$t->diag('Check that Flickr_* is used');
$t->isa_ok(Flickr::getUser(), Flickr_AuthedUser, 'User is a Flickr_AuthedUser');

$t->ok($Photo = current(Flickr::getRecentPhotos(1)), 'Photo loaded');
$t->isa_ok($Photo, Flickr_AuthedPhoto, 'Photo is a Flickr_AuthedPhoto');