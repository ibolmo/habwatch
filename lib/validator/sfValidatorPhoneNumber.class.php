<?php

/**
 * sfValidatorInteger validates an integer. It also converts the input value to an integer.
 *
 * @package        symfony
 * @subpackage validator
 * @author         Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version        SVN: $Id: sfValidatorInteger.class.php 9048 2008-05-19 09:11:23Z FabianLange $
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
        $this->addOption('pattern', "/(?:\([2-9]\d{2}\)\ ?|[2-9]\d{2}(?:\-?|\ ?))[2-9]\d{2}[- ]?\d{4}/");$this->setMessage('invalid', '"%value%" is not a phone number.');
        $this->addOption('required', false);
        
        $this->setMessage('invalid', '"%value%" is not a phone number.');
    }

    /**
     * @see sfValidatorBase
     */
    protected function doClean($value)
    {
        $clean = $this->cleanPhoneNumber($value);
        
        if (strval($clean) != $value['number']) {
            throw new sfValidatorError($this, 'invalid', array('value' => $value['number']));
        }
        
        return $clean;
    }
    
        
    public function cleanPhoneNumber($phone, $pattern = null)
	{
		if (!$pattern) $pattern = $this->getOption('pattern');
	    	        
		$number = preg_replace("/[^\d]/", '', $phone['number']);

		if ($number) {
		    preg_match($pattern, $number, $matched);
		}
		
		if (!isset($matched[0])) {
	        throw new sfValidatorError($this, 'invalid', array('value' => $number));
		}
		return $matched[0];
	}
}
