<?php

/**
 * account actions.
 *
 * @package    merhab
 * @subpackage account
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class accountActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        # sfGuardUser has password and username (disabled)
        
        # Profile has first, middle, and last name plus Emails
        
        
        $this->form = new ProfileForm();
    }
}
