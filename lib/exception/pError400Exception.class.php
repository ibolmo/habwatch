<?php

/**
 * sfError400Exception is thrown when a 400 error occurs in an action.
 *
 * @package    partisan
 * @subpackage exception
 * @author     Olmo Maldonado <ibolmo@ucla.edu>
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 */
class pError400Exception extends sfException
{
    /**
     * Forwards to the 400 action.
     */
    public function printStackTrace()
    {
        $exception = is_null($this->wrappedException) ? $this : $this->wrappedException;
      
        if (sfConfig::get('sf_debug')) {
            $response = sfContext::getInstance()->getResponse();
            if (is_null($response)) {
                $response = new sfWebResponse(sfContext::getInstance()->getEventDispatcher());
                sfContext::getInstance()->setResponse($response);
            }
        
            $response->setStatusCode(400);
            return parent::printStackTrace();
        } else {
            // log all exceptions in php log
            if (!sfConfig::get('sf_test')) {
                error_log($this->getMessage());
            }
            
            sfContext::getInstance()->getController()->forward(sfConfig::get('sf_error_400_module'), sfConfig::get('sf_error_400_action'));
        }
    }
}
