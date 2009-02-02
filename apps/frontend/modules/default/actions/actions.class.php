<?php

/**
 * default actions.
 *
 * @package    merhab
 * @subpackage default
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class defaultActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		
	}
	
	public function executeContact()
	{
	    $this->getResponse()->addJavascript('mootools');
	    $this->getResponse()->addJavascript('email');
	}
	
	public function executeTerms()
	{
	
	}
	
	public function executeInstructions(sfWebRequest $request)
	{
	}
	
	public function executeError404($request)
	{
	    $this->setLayout(false);
	    $this->renderText('An error has occurred');
	}
}
