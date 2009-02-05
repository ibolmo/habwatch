<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$t = $browser->test();

$result = GMap::geocode('Los Angeles, CA 90024');

$t->ok($result, 'Correctly geocoded');
$t->is($result['name'], 'Los Angeles, CA 90024', 'Geocoding worked');