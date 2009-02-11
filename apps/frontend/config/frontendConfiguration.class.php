<?php

class frontendConfiguration extends sfApplicationConfiguration
{
    public function configure()
    {       
        if ($phlickr_lib_dir = 'C:/www/habwatch/lib/vendor/phlickr/') {
            set_include_path($phlickr_lib_dir.PATH_SEPARATOR.get_include_path());
        }
    }
}
