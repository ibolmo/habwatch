<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$t = $browser->test();

$result = GMap::geocode('Los Angeles, CA 90024');

$t->ok($result, 'Correctly geocoded');
$t->is($result['name'], 'Los Angeles, CA 90024', 'Geocoding worked');

$t->is(GMap::getCoordinates($result), array('latitude' => 34.0631451, 'longitude' => -118.4367551), ':getCoordinates returns the correct Point');
$t->is(GMap::getCoordinates(GMap::geocode('Beverly Hills Blvd')), array('latitude' => 28.9237890, 'longitude' => -82.4546930), 'getCoordinates gets the first Point');