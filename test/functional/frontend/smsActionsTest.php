<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
define('SMS', '/sms');
define('IN_PHONE', '9568215736');

/**
* 
*/
class SMSTest extends sfTestBrowser
{
    static $uri = '/sms';
    
    public function sms($message, $from = IN_PHONE, $to = '')
    {
        return $this->get(self::$uri."/$from/$message/$to");
    }
}

$b = new SMSTest();
$t = $b->test();

$b->get(SMSTest::$uri)
  ->isStatusCode(404);
  
$b->sms('my message', 5555555555)
  ->isStatusCode(400)
  ->responseContains('not registered');

$b->sms('help');
$t->is($b->getResponse()->getContentType(), 'text/plain; charset=utf-8', 'Content type is plain text');
$b->responseContains('Usage:');
  
