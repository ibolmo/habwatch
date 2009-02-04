<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

define('IN_PHONE', '9568215736');

class SMSTest extends sfTestBrowser
{
    static $uri = '/sms';
    
    public function __construct($hostname = null, $remote = null, $options = array())
    {
        parent::__construct($hostname, $remote, $options);
        
    }
    
    public function sms($message, $from = IN_PHONE, $to = '')
    {
        return $this->get(self::$uri."/$from/$message/$to");
    }
}

$b = new SMSTest();
$t = $b->test();

$b->get(SMSTest::$uri)
  ->isStatusCode(404);

$t->diag('  Test incorrect phone');
$b->sms('my message', 22405)
  ->isStatusCode(400)
  ->responseContains('not registered');
  
$b->sms('my message', 5555555555)
  ->isStatusCode(400)
  ->responseContains('not registered');

$t->diag('  Test help usage');
$b->sms('help');
$t->is($b->getResponse()->getContentType(), 'text/plain; charset=utf-8', 'Content type is plain text');
$b->responseContains('Usage:');

$b->sms('')->responseContains('Usage:');
  
$b->sms('report 1 dead bird santa monica');
