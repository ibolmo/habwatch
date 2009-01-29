<?php

/**
 * sfValidatorPhoneNumber Takes an object (array) with number and disabled fields, and cleans the number to an appropiate format defined by the option: pattern.
 *
 * @package        merhab
 * @subpackage     validator
 * @author         Olmo Maldonado, <ibolmo@ucla.edu>
 */
class sfValidatorPhoneNumber extends sfValidatorBase
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
        $this->addOption('pattern', "/(?:\([2-9]\d{2}\)\ ?|[2-9]\d{2}(?:\-?|\ ?))[2-9]\d{2}[- ]?\d{4}/");
        $this->addOption('required', false);
        
        $this->setMessage('invalid', '"%value%" is not a phone number.');
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        $clean = $this->cleanPhoneNumber($value);
        $clean['disabled'] = (isset($value['disabled']) && $value['disabled'] == 'on') ? true : false;
        
        if (strval($clean['number']) != $value['number']) throw new sfValidatorError($this, 'invalid', array('value' => $value['number']));
        
        return $clean;
    }
    
        
    public function cleanPhoneNumber($phone, $pattern = null)
	{
		if (!$pattern) $pattern = $this->getOption('pattern');
	    	        
		$number = preg_replace("/[^\d]/", '', $phone['number']);
		if ($number) preg_match($pattern, $number, $matched);
		if (!isset($matched[0])) throw new sfValidatorError($this, 'invalid', array('value' => $number));
		$phone['number'] = $matched[0];
		
		return $phone;
	}
}
