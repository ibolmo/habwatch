<?php

/**
 * sfValidatorEmailAddress Takes an object (array) with address and disabled fields, and cleans the address to an appropiate format defined by the option: pattern.
 *
 * @package        merhab
 * @subpackage     validator
 * @author         Olmo Maldonado, <ibolmo@ucla.edu>
 */
class sfValidatorEmailAddress extends sfValidatorBase
{
    /**
     * Configures the current validator.
     *
     * @param array $options     An array of options
     * @param array $messages    An array of error messages
     *
     * @see sfValidatorBase
     */
    protected function configure($options = array(), $messages = array())
    {
        $this->addOption('pattern', "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum|edu)\b/");
        $this->addOption('required', false);
        
        $this->setMessage('invalid', '"%value%" is not an email address.');
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        $clean = $this->cleanEmailAddress($value);
        $clean['disabled'] = (isset($value['disabled']) && $value['disabled'] == 'on') ? true : false;
        
        if (strval($clean['address']) != $value['address']) throw new sfValidatorError($this, 'invalid', array('value' => $value['address']));
        
        return $clean;
    }
    
        
    public function cleanEmailAddress($email, $pattern = null)
	{
		if (!$pattern) $pattern = $this->getOption('pattern');
	    	        
		preg_match($pattern, $email['address'], $matched);
		if (!isset($matched[0])) throw new sfValidatorError($this, 'invalid', array('value' => $email['address']));
		$email['address'] = $matched[0];
		
		return $email;
	}
}
