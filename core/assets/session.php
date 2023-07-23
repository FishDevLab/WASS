<?php

namespace Indorker\Core\Assets;

class Session{


    public function start_session(){
        (!isset($_SESSION) ? session_start() : NULL);
        self::set_session();
        
    }

    private static function set_session(){
        $_SESSION['config'] = array();
    }

    public function stop_session(){
        (isset($_SESSION) ? $_SESSION = array() : NULL);
    }

}