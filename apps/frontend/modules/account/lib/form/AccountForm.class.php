<?php

/**
* 
*/
class AccountForm extends ProfileForm
{
	# Embed sfGuardUser form with disabled user
	    
    public function configure()
    {
    	unset($this['sf_guard_user_id']);
    }
}
