<?php

class defaultComponents extends sfComponents
{
    public function executeMenu(sfWebRequest $request)
    {
        $this->requestedUri = preg_replace('/\?.+$/', '', $request->getUri());
        $this->links = array(
            '@homepage' => array(
                'text' => 'Home'    
            )
        );
        
        if ($this->getUser()->isAuthenticated()) {
            $this->links = array_merge($this->links, array(
                '@tag' => array(
                    'text' => 'Tag'
                )
            ));
        }
    }
}