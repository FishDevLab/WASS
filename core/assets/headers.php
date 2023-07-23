<?php

namespace Indorker\Core\Assets;

class Headers
{
    public static array $google_domains = array(
    );
    
    public function google_random(){
        return 'https://'.self::$google_domains[rand(0, count(self::$google_domains) - 1)];
    }
}