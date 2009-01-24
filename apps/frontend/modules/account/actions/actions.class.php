<?php

/**
 * account actions.
 *
 * @package    merhab
 * @subpackage account
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class accountActions extends myActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->UserForm = new UserForm($this->User);
        $this->AccountForm = new AccountForm($this->User->Profile);
        
        if ($request->isMethod('post')) {
            # Todo, load default some how.
            $this->UserForm->bindAndSave(array_merge($request->getParameter('sf_guard_user', array()), array('username' => $this->User->username)));
            $this->AccountForm->bindAndSave($request->getParameter('profile'));
        }
    }
}
