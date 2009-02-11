<?php
include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());
$t = $browser->test();

define('TESTING_API_KEY', '58ac590250ef4eeb81e6d853ee942034');
define('TESTING_API_SECRET', '139c27ff722afe40');
define('TESTING_API_TOKEN', '418269-e278cc900dcd9787');

$result = new Phlickr_Api(TESTING_API_KEY, TESTING_API_SECRET, TESTING_API_TOKEN);

$t->ok($result);