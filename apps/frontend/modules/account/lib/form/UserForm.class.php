<?php

/**
* 
*/
class UserForm extends sfGuardUserForm
{
	public function configure()
	{
		unset(
			$this['algorithm'], $this['is_active'],
			$this['is_super_admin'], $this['last_login'],
			$this['created_at'], $this['updated_at'],
			$this['groups_list'], $this['permissions_list'],
			$this['salt']
		);
	}
}


?>