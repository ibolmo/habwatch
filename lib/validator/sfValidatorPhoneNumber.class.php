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
    public static $pattern = "/(?:\([2-9]\d{2}\)\ ?|[2-9]\d{2}(?:\-?|\ ?))[2-9]\d{2}[- ]?\d{4}/";
    
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
        $this->addOption('pattern', self::$pattern);
        $this->addOption('required', false);
        
        $this->setMessage('invalid', '"%value%" is not a phone number.');
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        if ($clean = self::cleanPhoneNumber($value['number'], $this->getOption('pattern'))){
            $value['number'] = $clean;
            $value['disabled'] = (isset($value['disabled']) && $value['disabled'] == 'on') ? true : false;
            return $value;
        }
        
        throw new sfValidatorError($this, 'invalid', array('value' => $value['number']));
    }
    
        
    public static function cleanPhoneNumber($number, $pattern = null)
    {
        if (!$pattern) $pattern = self::$pattern;
		$number = preg_replace("/[^\d]/", '', $number);
		preg_match($pattern, $number, $matched);		
		return isset($matched[0]) ? $matched[0] : false;
	}
}
