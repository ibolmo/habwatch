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
    public function preExecute()
    {
        $this->PhoneNumber = $this->User = false;
        
        if ($in_number = $this->getRequest()->getParameter('s_phone_number')) {
            $this->PhoneNumber = Doctrine::getTable('PhoneNumber')->findOneByNumber(sfValidatorPhoneNumber::cleanPhoneNumber($in_number));
            if ($this->PhoneNumber){
                $this->User = $this->PhoneNumber->Profile->User;
                $this->getUser()->setAttribute('user_id', $this->User->id);
            }
        }
        
        $this->getRequest()->setRequestFormat('sms'); 
        $this->getResponse()->setContentType('text/plain');
    }
    
    public function executeParse(sfRequest $request)
    {
        $this->forwardIf(!$this->User, 'sms', 'error400');
        $parsed = self::parse($request->getParameter('message', 'help'));
        $this->getUser()->setFlash('parsed', $parsed);
        $this->forward('message', $parsed['command']);
    }
    
    public static function parse($message)
    {
        $bits = explode(' ', $message);
        $command = array_shift($bits);
        
        switch ($command) {
            # report [quantity] condition subject location
            case 'report':
                $quantity = 1;
                
                if (is_numeric($bits[0])) $quantity = array_shift($bits);
                $condition = array_shift($bits);
                $subject = array_shift($bits);
                $location = implode(' ', $bits);
                
                return array(
                    'command' => $command,
                    'quantity' => $quantity,
                    'condition' => $condition,
                    'subject' => $subject,
                    'location' => $location
                );
                
            default:
                return array(
                    'command' => 'help'
                );
        }
    }
    
    public function executeError400(sfRequest $request)
    {
        $this->setLayout(false);
        $this->getResponse()->setStatusCode(400);
        return $this->renderText('Your phone number is not registered');
    }
}
