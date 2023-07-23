<?php

namespace Indorker\Core\Modules;

use Indorker\Core\Modules\Controls as Controls;
use Indorker\Core\Modules as Modules;

class Finder
{   
    protected static array $blacklist = array("php.","stackexchange","google","inurl","dork","stackoverflow.","gstatic.",".bing",".facebook",".instagram",".yahoo",".tiktok",".youtube",".twitter",".gmail.",".netflix",".disneyplus",".amazon",".primevideo",".ebay",".quora",".reddit",".deliveroo",".justeat",".owasp",".microsoft",".ask",".mozzilla",".1337day",".exploit-db",".packetstormsecurity",".w3",".torproject",".target",".jquery",".bootstrap",".metasploit",".apache",".hostname",".scanalert",".cache",".webcache");
    protected array $input;
    protected array $final;
    public static array $find_result;

    public function __construct(array $resultados){
        self::$find_result = [];
        $this->input = $resultados;
        $this->final = [];
    }

    public function find(){
        $this->find_url();
        ////////////////////////////////////////
        $this->filter_blacklist();
        $this->filter_redork();
        ////////////////| dont tuchit |//////////////////
        $this->output();
    }

    protected function find_url()
    {
        foreach($this->input as $rel => $result){
            if(preg_match("#\b(http[s]?://|ftp[s]?://){1,}?([-a-zA-Z0-9\.]+)([-a-zA-Z0-9\.]){1,}([-a-zA-Z0-9_\.\#\@\:%_/\?\=\~\-\//\!\'\(\)\s\^\:blank:\:punct:\:xdigit:\:space:\$]+)#si", $result)) {
                $this->find_info;
            }
        }
        print("\n=[+++] FILTER URLS FINDED [+++]=");
    }

    protected function find_info($site)
    {
        Modules\Connection::connect('HTTP-GET', $site);
        $response = Modules\Request::$response;
        self::$finded_url = $response['server']['url'];
        self::$finded_host = $response['host'];
        self::$finded_page = $response['page'];
        self::$finded_query = $response['query'];
        self::$finded_title = $response['title'];
        self::$finded_html = $response['html'];
    }

    private function filter_blacklist()
    {
        foreach(self::$find_result as $fin=>$f){
            foreach(self::$blacklist as $black){
                while(strstr($f,$black)){
                    unset(self::$find_result[$fin]);
                    break;
                }
            }
        }
        print("\n=[+++] BLACKLIST CHECKED [+++]=");
    }

    private function filter_redork(){
        if(isset(Controls\Options::$filter_dork)){
            switch(strtolower(Controls\Options::$filter_dork)){
                case "url":
                    foreach(self::$find_result as $num => $target){
                        if(!strstr(Controls\Options::$dork, $target)){
                            unset(self::$find_result[$num]);
                        }else{
                            echo "\n ! CONTIENE !\n";
                        }
                    }
                    break;
                case "text":
                    foreach(self::$find_result as $num => $target){
                        $page = file_get_contents('http://stackoverflow.com/questions/ask');
                        if(!strstr(Controls\Options::$dork, $page)){
                            unset(self::$find_result[$num]);
                        }
                        
                    }
                    break;
                case "title":
                    foreach(self::$find_result as $num => $target){
                        if(!strstr(Controls\Options::$dork, $target)){
                            unset(self::$find_result[$num]);
                        }
                    }
                    break;
                case "site":
                    strstr($dork, $host);
                    break;
                default:
                    print("\n[!!!] DORK FILTER AVAILABLE: url/text/title/site [!!!]");
                    break;
            }
        }
    }



    private function output(){
        print("\n");
        foreach(self::$find_result as $num => $result){
            print($result."\n");
        }
        /*$resultadoURL[0] = (is_array($resultadoURL) ? array_unique(array_filter($resultadoURL)) : $resultadoURL);
        $resultadoURL[0] = ($_SESSION['config']['unique'] ? __filterDomainUnique($resultadoURL[0]) : $resultadoURL[0]);
        $resultadoURL[0] = (not_null_empty($config['ifurl']) ? __filterURLif($resultadoURL[0]) : $resultadoURL[0]);
        $config['total_url'] = count($resultadoURL[0]);
        if (count($resultadoURL[0]) > 0) {
            $_config['user-agent'] = ($_config['shellshock']) ? $config['user_agent_xpl'] : $config['user-agent'];
            foreach ($resultadoURL[0] as $url) {
    
                __plus();
                $url = urldecode(not_null_empty($config['target']) ?
                                $config['target'] . $url : $url);
    
                if (__validateURL($url) || not_null_empty($config['abrir-arquivo'])) {
    
                    __processUrlExec(__filterURLTAG($url), $config["contUrl"] ++);
                    __plus();
                }
            }
        } else {
    
            print_r("{$_SESSION["c1"]}[ INFO ]{$_SESSION["c2"]} Not a satisfactory result was found!{$_SESSION["c0"]}\n");
        }*/
    }

    public function __destruct(){}
}
?>
