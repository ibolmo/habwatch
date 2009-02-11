<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardUser extends PluginsfGuardUser
{
    /**
     * Returns the email address of the User
     *
     * @author Olmo Maldonado, <ibolmo@ucla.edu>
     * @return string The User's email address
     */
    
    public function getEmailAddress()
    {
        return $this->Profile->Emails[0]->address;
    }

    /**
     * Sets the email address of the User
     *
     * @param string $email
     * @author Olmo Maldonado, <ibolmo@ucla.edu>
     */
    
    public function setEmailAddress($email)
    {
        $this->Profile->Emails[0]->address = $email;``
        $this->Profile->Emails->save();
    }
}