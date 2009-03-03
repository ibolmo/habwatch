<?php

class backendConfiguration extends sfApplicationConfiguration
{
    public function initialize()
    {
        parent::initialize();
        
        if ($phlickr_lib_dir = sfConfig::get('app_phlickr_lib_dir')) {
            set_include_path($phlickr_lib_dir.PATH_SEPARATOR.get_include_path());
        }
    }
}