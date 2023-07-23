<?php

namespace Indorker\Core\Modules;

use Indorker\Core\Assets as Assets;
use Indorker\Core\Modules as Modules;

class Scanner
{
    public array $dorks;
    public static string $dork;
    public array $engines;
    public static string $page;
    public int $page_limit;
    public int $page_increment;
    public int $record;
    public $scan_target;
    public $op;
    public $alias;
    public string $regex;
    protected array $tags = array();
    protected static array $seturl_values = array();
    protected array $seturl_labels;
    public static array $scan_result = array();

    private intval $set_rand;
    private intval $set_ip;

    public function __construct(array $dorks,array $engine)
    {
        $this->dorks = $dorks;
        $this->selected = $engine;
        $this->engines = Assets\Engines::$engines;
    }

    public function scan() // main scan
    {   
        print("\n\n===[ ::: ]   STARTING SCANNER   [ ::: ] ");
            print("\n===[ ::: ][ ".date('H:i:s - d-m-Y')." ][ ::: ]");
            $this->scan_dork();
    }

    protected function scan_dork()
    {
        foreach($this->dorks as $dork){
            print("\n\n===[ INFO ][ SEARCH ]:: $dork\n");
            self::$dork = $dork;
            $this->scan_engine();
        }
    }

    protected function scan_engine() // scanna engine
    {
        foreach($this->selected as $se){
            print("===[ INFO ][ ENGINE ]::  ".$this->engines[$se]['alias']." - ".$this->engines[$se]['engine']."\n");
            print("=[ ACTION ][ SCANNING ]:::...");
            // ---------------->
            $this->op = $this->engines[$se]['alias'];
            $this->alias = $this->engines[$se]['alias'];
            // ---------------->
            $this->scan_page($this->engines[$se]['host'],$this->engines[$se]['url']);
        }
    }

    protected function scan_page(string $host, string $url) // scana pagine
    {   
        for($i = 1; $i <= 10; $i++){
            //------------| SETTING URL |------------------>
            self::$page = $i * 10;
            $this->scan_target = "https://www.google.com/search?q=".self::$dork."&start=".self::$page."&sclient=gws-wiz-serp";
            //------------------------------>
            print("\n[ :".$i.": ]");
            // ---------------->
            Modules\Connection::connect('HTTP-GET', $this->scan_target,array());
            $this->check_curl(Modules\Connection::$resp_code);
        }
        Scanner::output();
    }

    private function check_curl($code){
        if($code === 200 || strstr(' 20',$code)){
            $this->result();       
        }else{
            echo "NON VA";
        }
    }

    private function check_bypass(){
        if(!strstr('GOOGLE',$this->alias)){
        }else{
            $bypass = new Modules\Bypasser($this->scan_target, Modules\Connection::$resp_redr, Modules\Connection::$resp_code, Modules\Connection::$resp_href);
            $bypass -> google_check();
            if(Modules\Bypasser::$bypass_results != false){
                array_push(self::$scanner_results, Modules\Bypasser::$bypass_results);
                echo "\n EVVAIIIIIII \n";
            }
        }
    }

    private function filter_regex(){
        if(isset(Controls\Options::$return_options['set-regex'])){
            $this->regex = $return_options['set-regex'];
        }elseif(isset(Controls\Options::$return_options['regex'])){
            switch($return_options['regex']){
                case '1':
                    $this->regex = "#\b(href=\"|src=\"|value=\"http[s]?://|href=\"|src=\"|value=\"ftp[s]?://){1,}?([-a-zA-Z0-9\.]+)([-a-zA-Z0-9\.]){1,}([-a-zA-Z0-9_\.\#\@\:%_/\?\=\~\-\//\!\'\(\)\s\^\:blank:\:punct:\:xdigit:\:space:\$]+)#si";
                    break;
                case '2':
                    break;
                case '3':
                    break;
                default:
                    break;
            }
        }else{
            $this->regex = "#\b(href=\"|src=\"|value=\"http[s]?://|href=\"|src=\"|value=\"ftp[s]?://){1,}?([-a-zA-Z0-9\.]+)([-a-zA-Z0-9\.]){1,}([-a-zA-Z0-9_\.\#\@\:%_/\?\=\~\-\//\!\'\(\)\s\^\:blank:\:punct:\:xdigit:\:space:\$]+)#si";
        }
        $this->regex = "#\b(href=\"|src=\"|value=\"http[s]?://|href=\"|src=\"|value=\"ftp[s]?://){1,}?([-a-zA-Z0-9\.]+)([-a-zA-Z0-9\.]){1,}([-a-zA-Z0-9_\.\#\@\:%_/\?\=\~\-\//\!\'\(\)\s\^\:blank:\:punct:\:xdigit:\:space:\$]+)#si";
        
    }

    /*protected function filter_tag(){
        foreach($this->input as $res => $r){
            $result = str_replace('"', '', str_replace('href="', '', str_replace('src="', '', str_replace('value="', '', $result)))); 
        }
    }*/

    private function result(){
        echo "===[+++] VALIDO [+++]\n";
        $res_html = Modules\Connection::$resp_href;
        $this->regex();
        preg_match_all($this->regex, $res_html, $res_html);
        $html = array_filter(array_unique($res_html[0]));
        array_push(self::$scan_result, $html);     
    }

    protected function output(){
        foreach(self::$scan_result as $num => $result){
            foreach($result as $arr){
                print($arr."\n");
            }
        }    
    }

    public function __destruct(){}


}
?>
