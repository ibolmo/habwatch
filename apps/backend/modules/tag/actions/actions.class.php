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
        $this->PhotoPager = Flickr::getPager($this->page, sfConfig::get('app_tag_photos_page_max'));
        
        $response = $this->getResponse();
        $response->addStylesheet('tagger', 'last');
        $response->addJavascript('mootools');
        $this->getResponse()->addJavascript('tagger');
    }
}
