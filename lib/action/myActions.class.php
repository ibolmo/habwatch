<?php

/**
* Originally pActions from Partisan. A collection of useful methods for the project.
* @author Olmo Maldonado, <ibolmo@ucla.edu>
*/

class myActions extends sfActions
{
    public function preExecute()
    {   
        $this->User = ($this->User = $this->getUser()->getGuardUser()) ? $this->User : false;
    }
    
    /**
     * Sends an email to the correspondent about their Partisan registration.
     *
     * @param string $subject The subject line of the email
     * @param string $message The text/html message to send
     * @param string $to The email address of the recipient
     * @author Olmo Maldonado, <ibolmo@ucla.edu>
     */
    
    public function sendEmail($subject, $message, $to)
    {        
        $conn = new Swift_Connection_SMTP('smtp.gmail.com', 465, Swift_Connection_SMTP::ENC_SSL);
        $conn->setUsername(sfConfig::get('app_smtp_username'));
        $conn->setPassword(sfConfig::get('app_smtp_password'));
        
        $mailer = new Swift($conn);        
        $mailer->send(new Swift_Message($subject, $message, 'text/html'), $to, sfConfig::get('app_outgoing_emails_from'));
        $mailer->disconnect();
    }
    
    /**
    * Forwards current action to the default 400 error action.
    *
    * @param string $message Message of the generated exception
    *
    * @throws pError400Exception
    *
    */
    public function forward400($message = null)
    {
        throw new pError400Exception($this->get400Message($message));
    }
    
    /**
    * Forwards current action to the default 400 error action unless the specified condition is true.
    *
    * @param bool    $condition  A condition that evaluates to true or false
    * @param string  $message    Message of the generated exception
    *
    * @throws pError400Exception
    */
    public function forward400Unless($condition, $message = null)
    {
        if (!$condition) {
            throw new pError400Exception($this->get400Message($message));
        }
    }
    
    /**
    * Forwards current action to the default 400 error action if the specified condition is true.
    *
    * @param bool    $condition  A condition that evaluates to true or false
    * @param string  $message    Message of the generated exception
    *
    * @throws pError400Exception
    */
    public function forward400If($condition, $message = null)
    {
        if ($condition) {
            throw new pError400Exception($this->get400Message($message));
        }
    }

    /**
    * Redirects current action to the default 400 error action (with browser redirection).
    *
    * This method stops the current code flow.
    */
    public function redirect400()
    {
        return $this->redirect('/'.sfConfig::get('sf_error_400_module').'/'.sfConfig::get('sf_error_400_action'));
    }

    /**
    * Returns a formatted message for a 400 error.
    *
    * @param  string $message An error message (null by default)
    *
    * @return string The error message or a default one if null
    */
    protected function get400Message($message = null)
    {
        return is_null($message) ? 'The request had bad syntax or could not be interpreted' : $message;
    }
}
