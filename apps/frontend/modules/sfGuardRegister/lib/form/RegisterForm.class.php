<?php

class RegisterForm extends sfGuardUserForm
{
    public function configure()
    {    
        unset(
            $this['is_active'],
            $this['is_super_admin'],
            $this['updated_at'],
            $this['groups_list'],
            $this['permissions_list'],
            $this['last_login'],
            $this['created_at'],
            $this['salt'],
            $this['algorithm']
        );
        
        $this->validatorSchema['username']->setMessage('required', 'Please enter a username');
        
        $this->widgetSchema['email_address'] = new sfWidgetFormInput();
        $this->widgetSchema->moveField('email_address', sfWidgetFormSchema::AFTER, 'username');
        $this->validatorSchema['email_address'] = new sfValidatorAnd(array(
            new sfValidatorEmail(array('required' => true), array(
                'invalid' => 'Invalid email address',
                'required' => 'Please enter an email address'
            )),
            new sfValidatorDoctrineUnique(array(
                'model' => 'Email',
                'column' => 'address'
            ), array(
                'invalid' => 'Email address is already in use'    
            ))
        ));
        
        $this->validatorSchema['password']->setMessage('required', 'Please enter a password');
        $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
         
        $this->mergePostValidator(new sfValidatorSchemaCompare('password', '==', 'password_confirmation', array(), array(
            'invalid' => 'The two passwords must be the same.'
        )));
    }   
}