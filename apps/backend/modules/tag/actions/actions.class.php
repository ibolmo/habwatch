<?php

/**
 * tag actions.
 *
 * @package    habwatch
 * @subpackage tag
 * @author     Olmo Maldonado, <ibolmo@ucla.edu>
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class tagActions extends myActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        $this->page = $request->getParameter('page', 1);
        $this->getUser()->setAttribute('tagger-page', $this->page);
        $this->PhotoPager = Flickr::getPager($this->page, sfConfig::get('app_tag_photos_page_max'));
        
        $response = $this->getResponse();
        $response->addStylesheet('tagger', 'last');
        $response->addStylesheet('star_rating');
        $response->addJavascript('mootools');
        $response->addJavascript('rater.js');
    }
    
    public function executeUpdate(sfWebRequest $request)
    {
        if (!$request->isXmlHttpRequest()) return $this->jsonError('Use the correct interface');
        if (!$this->photo_id = $request->getParameter('photo_id')) return $this->jsonError('No photo id provided');
        
        $this->errors = array();
        
        $Photo = new Flickr_AuthedPhoto(Flickr::getInstance(), $this->photo_id);
        $Photo->getRating()->set($request->getParameter('star', 0));
        
        $this->setLayout(false);
    }
    
    public function jsonError($message)
    {
        if (class_exists('FB')) FB::error($message);
        $this->getResponse()->setContentType('text/plain');
        return $this->renderText(json_encode(array(
            'error' => $message
        )));
    }
}
