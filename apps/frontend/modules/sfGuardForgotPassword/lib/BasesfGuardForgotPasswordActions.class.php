<?php
/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage sfGuardDoctrinePlugin
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 */
class BasesfGuardForgotPasswordActions extends myActions
{
  /**
   * executePassword
   *
   * Form for requesting instructions on how to reset your password
   *
   * @return void
   * @author Jonathan H. Wage
   */
	public function executePassword($request)
	{
	    $this->form = new ForgotPasswordForm();
	    
	    if ($request->isMethod('post')) {
	        $email_address = $request->getParameter('email_address');
	        $this->form->bind(array('email_address' => $email_address));
	        if ($this->form->isValid()) {
	            $sfGuardUser = sfGuardUserTable::findOneByEmailAddress($email_address);
	            
	            if ($sfGuardUser && $sfGuardUser->getId()){
        			$rawEmail = $this->getPartial('send_request_reset_password', array('sfGuardUser' => $sfGuardUser));
        			$this->sendEmail('Request to reset password', $rawEmail, $sfGuardUser->getEmailAddress());
        			$this->redirect('@sf_guard_password_success');
        		}
	        }
	    }
	}
	
	public function executePassword_success()
	{
	}


	/**
	 * executeReset_password 
	 *
	 * Reset the users password and e-mail it
	 * 
	 * @access public
	 * @return void
	 */
	public function executeReset_password($request)
	{
		$sfGuardUser = sfGuardUserTable::findOneByIdAndPassword($request->getParameter('id'), $request->getParameter('key'));
		$this->forward404Unless($sfGuardUser, 'Incorrect key/id combination');

		$newPassword = crc32(time());
		$sfGuardUser->setPassword($newPassword);
    	$sfGuardUser->save();
		
		$rawEmail = $this->getPartial('send_reset_password', array(
		    'username' => $sfGuardUser->getUsername(), 
		    'password' => $newPassword
		));
		
		$this->sendEmail('Password reset successfully', $rawEmail, $sfGuardUser->getEmailAddress());
	}
}