<?php

namespace Indorker\Core\Modules;

use Indorker\Core as Core;
use Indorker\Core\Assets as Assets;
use Indorker\Core\Modules as Modules;
use Indorker\Core\Modules\Controls as Controls;

class Connection
{   
    public static $resp_code;
    public static $resp_href;
    public static $resp_redr;
    public static $response;

    public static function connect(string $conn_type, string $conn_urls, array $settings){
        $conn_urls = array($conn_urls);
        switch($conn_type){
            case "PING":
                break;
            case "HTTP-GET" || "HTTP-POST":
                $request = new Modules\Request($conn_urls);
                self::sets($settings,$conn_type);
                $request->start();
                self::$resp_code = Modules\Request::$response['server']['http_code'];
                self::$resp_href = str_replace('href="/url?q=', 'href="', Modules\Request::$response['html']);
                self::$resp_redr = Modules\Request::$response['server']['redirect_url'];
                self::$response = Modules\Request::$response['server'];
                break;
            default:
                break;
            
        }
    }

    private static function sets(array $sets, $type){
        Modules\Settings::set_method($type);
        foreach($sets as $set => $opt){
            switch(strtoupper($set)){
                case "METHOD":
                    break;
                case "HEADER":
                    Modules\Settings::set_header($opt);
                    break;
                case "USERAGENT":
                    Modules\Settings::set_usragnt($opt);
                    break;
                case "REFERER":
                    Modules\Settings::set_referer($opt);
                    break;
                case "COOKIES":
                    Modules\Settings::set_cookies($opt);
                    break;
                case "TIMEOUT":
                    Modules\Settings::set_timeout($opt);
                    break;
                case "DELAY":
                    Modules\Settings::set_delay($opt);
                    break;
                case "PROXY":
                    Modules\Settings::set_proxy($opt);
                    break;
                case "DOMAIN":
                    Modules\Request::set_domain($opt);
                    break;
                case "APIDOM":
                    Modules\Request::set_apidom();
                    break;
                default:
                    break;
                
            }
        }
    }

}
?>
