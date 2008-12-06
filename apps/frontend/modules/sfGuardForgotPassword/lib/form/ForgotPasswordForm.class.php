<?php

class ForgotPasswordForm extends sfForm
{
    public function configure()
    {
        $this->setWidgets(array(
            'email_address' => new sfWidgetFormInput()
        ));
                
        $this->setValidators(array(
            'email_address' => new sfValidatorAnd(array(
                new sfValidatorEmail(array(), array(
                    'invalid' => 'Invalid email address'
                ))
            ))
        ));
    }
    
}


?>