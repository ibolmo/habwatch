<?php
class BasesfGuardRegisterActions extends myActions
{
    public function preExecute()
    {
        $this->redirectIf($this->getUser()->isAuthenticated(), '@homepage');
    }
    
    /**
     * Displays the Registration Form, and creates a new sfGuardUser.
     *
     * @param sfRequest $request 
     * @author Olmo Maldonado, <ibolmo@ucla.edu>
     */
    
    public function executeIndex($request)
    {        
        $this->form = new RegisterForm();
        
        if ($request->isMethod('post')) {
            $this->form->bind($request->getParameter('sf_guard_user'));
            if ($this->form->isValid()){
                $userInfo = $this->form->getValues();
                
                $sfGuardUser = new sfGuardUser();
                $sfGuardUser->merge($userInfo);
                $sfGuardUser->setIsActive(0);
                $sfGuardUser->Profile->Emails[0]->address = $userInfo['email_address'];
                
                $message = $this->getPartial('send_confirm_registration', array('sfGuardUser' => $sfGuardUser));
                $this->sendEmail(sfConfig::get('app_project_name').' Registration Confirmation', $message, $userInfo['email_address']);
                
                $sfGuardUser->save();
                $this->redirect('@sf_guard_register_success');
            }
        }
    }
    
    public function executeRegister_success()
    {
    }
    
    /**
     * Confirms the User's registration by setting active if inactive.
     *
     * @param string $request 
     * @author Olmo Maldonado, <ibolmo@ucla.edu>
     */
    
    public function executeConfirm($request)
    {
        $sfGuardUser = sfGuardUserTable::findOneByUsernameAndPassword($request->getParameter('username'), $request->getParameter('key'), false);
        $this->forward400Unless($sfGuardUser, 'Incorrect username and password or user already confirmed');
    
        $message = $this->getPartial('send_register_complete');
        $this->sendEmail('Partisan Registration Completed', $message, $sfGuardUser->getEmailAddress());
        
        $sfGuardUser->setIsActive(1);
        $sfGuardUser->save();
    }
}