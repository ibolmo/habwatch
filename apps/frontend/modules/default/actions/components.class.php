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
            '@instructions' => array(
                'text' => 'Instructions',
                'invisible' => $this->getUser()->isAuthenticated()
            )
        );
    }
}

/*
<ul class="tabs">
  <li><?php echo anchor('home', 'Home', 			 ($class_name == 'home') 	  ? 'class="active"' : '') ?></li>
  <?php if (!$this->session->userdata('user_id')): ?>
  <li><?php echo anchor('account', 'Account', 		 ($class_name == 'account')   ? 'class="active"' : '') ?></li>
  <?php endif ?>
  <li><?php echo anchor('result', 'All Results', 		 ($class_name == 'result') 	  ? 'class="active"' : '') ?></li>
  <?php if ($this->session->userdata('user_id')): ?>
  <li><?php echo anchor('sites', 'My Data', 		 ($class_name == 'sites') 	  ? 'class="active"' : '') ?></li>
  <li><?php echo anchor('account', 'Update Account', ($class_name == 'account')   ? 'class="active"' : '') ?></li>
  <li><?php echo anchor('cellphone', 'Notes to Add', ($class_name == 'cellphone') ? 'class="active"' : '') ?></li>
  <li><?php echo anchor('login/instructions', 'Instructions', ($class_name == 'instructions') ? 'class="active"' : '') ?></li>
  <?php endif ?>
</ul>
<?php */