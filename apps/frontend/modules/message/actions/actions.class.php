<?php

/**
 * message actions.
 *
 * @package    merhab
 * @subpackage message
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class messageActions extends myActions
{
    public function preExecute()
    {
        parent::preExecute();
        if (!$this->User && $id = $this->getUser()->getAttribute('user_id')) {
            $this->User = Doctrine::getTable('sfGuardUser')->findOneById($id);
        }
        $this->forward404Unless($this->parsed = $this->getUser()->getFlash('parsed'));
    }
    
    # report [quantity] cond. subj. loc.
    public function executeReport(sfRequest $request)
    {
        $Report = new Report();
        $Report->fromArray($this->parsed);
        $Report->Location = $this->parsed['location'];
        $Report->save();
    }
    
    public function executeHelp(sfRequest $request)
    {
    }
}
