<?php
require_once(dirname(__FILE__).'/../../../config/app.php');
class frontendConfiguration extends sfApplicationConfiguration
{
    public function configure()
    {       
        if ($phlickr_lib_dir = trim(PHLICKR_LIB_DIR)) {
            set_include_path($phlickr_lib_dir.PATH_SEPARATOR.get_include_path());
        }
    }
}
