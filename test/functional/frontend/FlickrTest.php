<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$b = new sfTestFunctional(new sfBrowser());
$t = $b->test();

$api = Flickr::getInstance();