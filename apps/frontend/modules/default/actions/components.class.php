<?php

class defaultComponents extends sfComponents
{
    public function executeMenu(sfWebRequest $request)
    {
        $this->requestedUri = $request->getUri();
        $this->links = array(
            '@homepage' => array(
                'text' => 'Home'    
            ),
            '@about' => array(
                'text' => 'About'
            ),
            '@instructions' => array(
                'text' => 'Instructions'
            )
            /*
            '@reports' => array(
                'text' => 'Reported HABs'
            )
            //*/
        );
        
        if ($this->getUser()->isAuthenticated()) {
            $this->links = array_merge($this->links, array(
                '@account' => array(
                    'text' => 'Account'
                ),
                /*
                '@data' => array(
                    'text' => 'Your Reports'  
                ),
                '@drafts' => array(
                    'text' => 'Drafts'  
                ),
                //*/
            ));
        }
    }
}