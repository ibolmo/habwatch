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
        $response->addJavascript('mootools');
        $response->addJavascript('RubberBand');
        $response->addJavascript('tagger');
    }
    
    public function executeUpdate(sfWebRequest $request)
    {
        switch (true) {
            case !$request->isXmlHttpRequest(): return $this->jsonError('Use the correct interface');
            case !$page = $this->getUser()->getAttribute('tagger-page'): return $this->jsonError('No page set');
        }
        $this->selected = $request->getParameter('selected', array());
        $this->errors = array();
        
        $PhotoPager = Flickr::getPager($page, sfConfig::get('app_tag_photos_page_max'));
        $previous = array_filter($PhotoPager->getResults(), array($this, 'useful_photos'));
        $noLongerUseful = array_values(array_filter($previous, array($this, 'no_longer_useful')));
        
        foreach ($noLongerUseful as $Photo) {
            try {
                $Photo->removeTag('useful');
            } catch (Exception $e) {
                $errors[] = array('photo_id' => $Photo->getId(), 'message' => 'Tag not found');
            }
        }
        
        foreach ($this->selected as $photo_id) {
            $Photo = Flickr::getPhoto($photo_id);
            if (!$Photo) $this->errors[] = array('photo_id' => $photo_id, 'message' => 'Could not be found');
            $Photo->addTags('useful');
        }
        
        $this->setLayout(false);
    }
    
    public function useful_photos($Photo)
    {
        return $Photo->hasTag('useful');
    }
    
    public function no_longer_useful($Photo)
    {
        return !in_array($Photo->getId(), $this->selected);
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
