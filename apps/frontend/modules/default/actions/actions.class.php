<?php

/**
 * default actions.
 *
 * @package    habwatch
 * @subpackage default
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class defaultActions extends myActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
	    if ($this->User && !$this->getUser()->getAttribute('visited')){
	    	$this->addIntro($request);
	    }
	}
	
	public function addIntro($request)
	{
		if (preg_match('/^dev/', $request->getHost())) return;
        $response = $this->getResponse();
	    $this->getUser()->setAttribute('visited', true);
	    $this->introduce = true;
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
	    $this->getResponse()->addJavascript('mootools');
	    $this->getResponse()->addJavascript('sliding-tabs');
	    $this->getResponse()->addJavascript('instructions');
	}
	
	public function executeError404($request)
	{
	    $this->setLayout(false);
	    $this->renderText('An error has occurred');
	}
    
    public function executeAbout(sfWebRequest $request)
    {
    }
    
    public function executeConfigOpenLayers()
    {
    }
}
