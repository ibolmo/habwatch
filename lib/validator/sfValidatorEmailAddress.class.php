<?php

/**
 * sfValidatorEmailAddress Takes an object (array) with address and disabled fields, and cleans the address to an appropiate format defined by the option: pattern.
 *
 * @package        habwatch
 * @subpackage     validator
 * @author         Olmo Maldonado, <ibolmo@ucla.edu>
 */
class sfValidatorEmailAddress extends sfValidatorBase
{
    public static $pattern = "/[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+(?:[A-Z]{2}|com|org|net|gov|mil|biz|info|mobi|name|aero|jobs|museum|edu)\b/";
    
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
        
        $this->setMessage('invalid', '"%value%" is not an email address.');
    }
	
    /**
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        if ($clean = self::cleanEmailAddress($value['address'], $this->getOption('pattern'))){
            $value['address'] = $clean;
            $value['disabled'] = (isset($value['disabled']) && $value['disabled'] == 'on') ? true : false;
            return $value;
        }
        
        throw new sfValidatorError($this, 'invalid', array('value' => $value['address']));
    }
    
        
    public static function cleanEmailAddress($address, $pattern = null)
    {
        if (!$pattern) $pattern = self::$pattern;
		preg_match($pattern, $address, $matched);		
		return isset($matched[0]) ? $matched[0] : false;
	}
}
