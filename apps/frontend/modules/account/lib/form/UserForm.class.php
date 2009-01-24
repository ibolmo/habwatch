<?php

/**
* 
*/
class UserForm extends sfGuardUserForm
{
	public function configure()
	{
		unset(
			$this['algorithm'], $this['is_active'],
			$this['is_super_admin'], $this['last_login'],
			$this['created_at'], $this['updated_at'],
			$this['groups_list'], $this['permissions_list'],
			$this['salt']
		);
		
		$this->widgetSchema['username'] = new sfWidgetPlainText();
        $this->validatorSchema['username'] = new sfValidatorPass();
		
        $this->validatorSchema['password']->setMessage('required', 'Please enter a password');
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password']->setOption('required', false);
        
        $this->widgetSchema['password_confirmation'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['password_confirmation']->setLabel('Confirm');
        $this->validatorSchema['password_confirmation'] = clone $this->validatorSchema['password'];
         
        $this->mergePostValidator(new sfValidatorSchemaCompare('password', '==', 'password_confirmation', array(), array(
            'invalid' => 'The two passwords must be the same.'
        )));
	}
}


?>