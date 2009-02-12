<?php

require_once 'app.php';
require_once trim(PEAR_SF_DIR).'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enableAllPluginsExcept(array('sfPropelPlugin', 'sfCompat10Plugin'));
  }
}
