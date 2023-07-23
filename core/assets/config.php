<?php

namespace Indorker\Core\Assets;

class Config{

    public function set_configs(){
        error_reporting(1);
        set_time_limit(0);
        ini_set('memory_limit', '256M');
        ini_set('display_errors', 1);
        ini_set('max_execution_time', 0);
        ini_set('allow_url_fopen', 1);
    }

}