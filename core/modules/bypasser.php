<?php

namespace Indorker\Core\Modules;

use Indorker\Core\Modules as Modules;

class Bypasser
{   
    private static int $r;
    public static int $max = 11;
    public static $target;
    public $html;
    public $rehtml;
    public static string $alert;
    public static string $urlert;
    public string $reg;
    public $redir;
    public $code;
    public static array $total_result;
    public static $bypass_results;

    public array $redirected = array(
        "UnusualTraffic" => array(
                                        'http_r_url' => ".com/sorry/index?continue=",
                                        'httpcode' => 302,
                                        'httpalert' => "Our systems have detected unusual traffic from your computer network",
                                        'httpcaptcha' => ""
                                        ),
        "CookiesAgree" => array(
                                        'http_r_url' => ".com/?",
                                        'httpcode' => 200,
                                        'httpalert' => "Before you continue to Google",
                                        'httpagree' => "Accept all",
                                        'httpbotton' => "L2AGLb"));
        /*),
        "PrivacyConfirm" => array(
                                        'httpcode' => 200,
                                        'httpalert' => "Before you continue to Google",
                                        'httpconfirm' => "Accept",
                                        )
    );*/
    
    public function __construct(string $target, $redir, $code, $html){ //$redirect_url, $redirect_code, $html){
        self::$target = $target;
        $this->redir = $redir;
        $this->html = $html;
        $this->code = $code;
        $this->reg =  "#\b(href=\"|src=\"|value=\"http[s]?://|href=\"|src=\"|value=\"ftp[s]?://){1,}?([-a-zA-Z0-9\.]+)([-a-zA-Z0-9\.]){1,}([-a-zA-Z0-9_\.\#\@\:%_/\?\=\~\-\//\!\'\(\)\s\^\:blank:\:punct:\:xdigit:\:space:\$]+)#si";
        self::$total_result = array();
        self::$r = 0;
    }

    public function google_check(){
        foreach($this->redirected as $red => $r){
            while(strstr($this->redir, $r['http_r_url']) || strstr($this->html, $r['httpalert']) && $this->code == $r['httpcode']){                
                switch($red){
                    case "UnusualTraffic":
                        self::$urlert = $r['http_r_url'];
                        self::$alert = $r['httpalert'];
                        echo "UNUSUAL TRAFFIC DETECTED \n";
                        print(" - try bypass url - \n");
                        self::$r += 1;
                        $this->google_unusual_traffic();
                        break;
                    /*case "cookiesagree":
                        $this->google_accept_cookies();
                        break;
                    case "privacyconfirm":
                        $this->google_confirm_privacy($r['httpcode'],$r['httpalert']);
                        break;*/
                    default:
                        break;
                }
                break;
            }
        }
    }

    private function google_accept_cookies(int $code, string $message){
        
    }

    private function google_confirm_privacy(int $code, string $message){

    }

    private function google_unusual_traffic(){
        $n = self::$r;
        while($n >= 1 && $n <= 55){
            if($n >= 0 && $n <= 30){ // stealth mode SLOW
                $sets = array("header"=>"standard","usragnt"=>"random","timeout"=>$n,"cookies"=>"consent","domain"=>"random");
                Modules\Connection::connect('HTTP-GET', self::$target, $sets);
            }elseif($n > 40 && $n <= 50){ // stealth mode AGGRESSIVE
                $sets = array("header"=>"obfuscate","referer"=>"obfuscate","usragnt"=>"obfuscate","timeout"=>8,"cookies"=>"refuse","domain"=>"random-trix");
                Modules\Connection::connect('HTTP-GET', self::$target, $sets);
            }elseif($n > 50 && $n <= 55){// stealth mode SNEAKY
                $sets = array("apidom"=>"","cookies"=>"consent"); //call to cse google api
                Modules\Connection::connect('HTTP-GET', self::$target, $sets);
            }
            Bypasser::bypasser_check(Modules\Connection::$resp_code,Modules\Connection::$resp_href);
            break;
        }
        Bypasser::bypasser_results();
    }

    public function bypasser_check(string $cd, string $html){
        if($cd == 200 && !strstr($html, self::$urlert)){
            print("\n BYPASS SUCCESS \n");
            $res_html = Modules\Connection::$resp_href;
            preg_match_all($this->reg, $res_html, $res_html);
            $html = array_filter(array_unique($res_html[0]));
            array_push(self::$total_result, $html);
        }else{
            print(".");
            self::$r += 1;
            Bypasser::google_unusual_traffic(); //chiamata ricorsiva alla """unibo"""
        }
    }

    public static function bypasser_results(){

        if(isset(self::$total_result)){
            self::$bypass_results = self::$total_result;
        }else{
            self::$bypass_results = false;
        }

    }
}
?>
