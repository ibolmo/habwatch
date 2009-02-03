<?php

/**
 * sms actions.
 *
 * @package    merhab
 * @subpackage sms
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class smsActions extends sfActions
{
    static $help = '
Usage:
  mh [cmd] [qty] cond subj loc
Where each can be:
  cmd: report, list, help, note
  qty: 1, 2, ... , five, six ...
  cond: dead, sick, ...
  subj: fish, ...';
    
    public function preExecute()
    {
        $this->PhoneNumber = $this->User = false;
        
        if ($in_number = $this->getRequest()->getParameter('s_phone_number')) {
            $this->PhoneNumber = Doctrine::getTable('PhoneNumber')->findOneByNumber(sfValidatorPhoneNumber::cleanPhoneNumber($in_number));
            if ($this->PhoneNumber) $this->User = $this->PhoneNumber->Profile->User;
        }
        
        $this->getResponse()->setContentType('text/plain');
    }
    
    public function executeParse(sfRequest $request)
    {
        $this->forwardIf(!$this->User, 'sms', 'error400');
        $this->setVar('parsed', self::parse($request->getParameter('message', '')));
        $this->forward('message', $parsed['command']);
    }
    
    public static function parse($message)
    {
        return array('command' => 'help');
    }
    
    public function executeError400(sfRequest $request)
    {
        $this->setLayout(false);
        $this->getResponse()->setStatusCode(400);
        return $this->renderText('Your phone number is not registered');
    }
    
    public function executeHelp()
    {
        $this->setLayout(false);
        return $this->renderText(self::$help);
    }
}
