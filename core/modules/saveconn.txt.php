<?php

namespace Indorker\Core\Modules;

use Indorker\Core as Core;
use Indorker\Core\Assets as Assets;
use Indorker\Core\Modules as Modules;
use Indorker\Core\Modules\Controls as Controls;

class Connection
{   
    protected $request_init;
    public array $request_opts = array();
    public array $request_target= array();
    public static $last_code;

    protected $status = NULL;
    protected array $response;
    public static array $result;
    protected array $request_urls;

    public function __construct(string $target){ //inizialize data
        $this->request_target = array();
        $this->request_urls = array();
        $this->response = array();
        $this->request_opts = array(CURLOPT_HEADER => 1,
                                        CURLOPT_HTTPHEADER => array('Cache-Control: no-cache','Content-Type: application/x-www-form-urlencoded; charset=utf-8'),
                                        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/110.0",
                                        CURLOPT_SSL_VERIFYPEER => 0,
                                        CURLOPT_SSL_VERIFYHOST => 0,
                                        CURLOPT_FRESH_CONNECT => 1,
                                        CURLOPT_RETURNTRANSFER => 1,
                                        CURLOPT_COOKIEFILE => 'cookie.txt',
                                        CURLOPT_COOKIEJAR => 'cookie.txt'
                                    );
    }

    public function set_header(string $type){
        if($type == 'MANUAL' && isset(Controls\Options::$return_options['set-header'])){
            $this->request_opts[CURLOPT_HTTPHEADER] = array(explode(Controls\Options::$return_options['set-header']));
        }elseif($type == 'OBFUSCATE'){
            array_push($this->request_opts[CURLOPT_HTTPHEADER],"X-Forwarder: 127.0.0.1", "X-Origin: 127.0.0.1");
        }
    }

    public function set_useragent(string $type){
        if($type == 'MANUAL' && isset(Controls\Options::$return_options['user-agent'])){
            $this->request_opts[CURLOPT_USERAGENT] = explode(Controls\Options::$return_options['user-agent']);
        }elseif($type == 'RANDOM' ){//isset(Controls\Options::$return_options['random-agent'])){
            $rb = Assets\UserAgent::$browser;
            $rs = Assets\UserAgent::$system;
            $lc = Assets\UserAgent::$locations;
            $this->request_opts[CURLOPT_USERAGENT] = $rb[rand(0,count($rb)-1)].'/'.rand(1, 20).'.'.rand(0, 20).'('.$rs[rand(0,count($rs) - 1)].' '.rand(1, 7).'.'.rand(0, 9).'; '.$lc[rand(0,count($lc)-1)].';)';
            //print("\n | AGENT: ".$this->request_opts[CURLOPT_USERAGENT]."\n");
        }
    }

    public function set_referer(string $type){
        if($type == 'MANUAL' && isset(Controls\Options::$return_options['referer'])){
            $this->request_opts[CURLOPT_AUTOREFERER] = false;
            $this->request_opts[CURLOPT_REFERER] = explode(Controls\Options::$return_options['referer']);
        }elseif($type == 'RANDOM' ){//isset(Controls\Options::$return_options['random-agent'])){
            $this->request_opts[CURLOPT_AUOREFERER] = false;
            $this->request_opts[CURLOPT_REFERER] = Assets\Referer::referer_random();
        }elseif($type == 'OBFUSCATE' ){//isset(Controls\Options::$return_options['random-agent'])){
            $this->request_opts[CURLOPT_AUTOREFERER] = false;
            $exp = explode('//', $this->request_target[0]);
            $exp = explode('?q=', $exp[1]);
            $this->request_opts[CURLOPT_REFERER] = $exp[0];
            echo $exp[0];
        }
    }

    public function set_timeout(int $time){
        $this->request_opts[CURLOPT_TIMEOUT] = $time;
        $this->request_opts[CURLOPT_CONNECTTIMEOUT] = $time;
    }
    
    public function set_cookies(string $type){
        if($type == 'MANUAL' && isset(Controls\Options::$return_options['set-cookies'])){
            $setted_cookies = Controls\Options::$return_options['set-cookies'];
            $this->request_opts[CURLOPT_COOKIEFILE] = $setted_cookies;
            $this->request_opts[CURLOPT_COOKIEJAR] = $setted_cookies;
        }elseif('CONSENT'){
            array_push($this->request_opts[CURLOPT_HTTPHEADER],"Cookie: disclaimer_accepted=true");
            $this->request_opts[CURLOPT_COOKIEFILE] = 'cookie.txt';
            $this->request_opts[CURLOPT_COOKIEJAR] = 'cookie.txt';
        }
    }

    public function test(){
        $connected = @fsockopen("www.google.com", 80);
        print("\n===[ *** ] CHECK CONNECTION: "); 
        if ($connected){
            $is_conn = true;
            fclose($connected);
        }else{
            $is_conn = false;
        }
        if($is_conn = true)
        {
            print(" STABLE");
            return true;
        }else{
            print(" FAILED\n");
            print("\n===[ ! ] ERROR: CONNECTION FAILED [ ! ]");
            print("\n===[ - ] CHECK YOUR INTERNET CONNECTION [ - ]");
            exit(0);
            return false;
        }
    }

    public function change_domain(){
        $target = (!isset($this->request_target))? $this->request_target : $this->request_target[0];
        $targ = explode('/s',$target);
        $query = $targ[1];
        $random = Assets\Engines::google_random();
        $this->request_target = array($random."/s".$query);
    }

    public function unset(){
        //echo shell_exec("anonsurf stop");
    }

    public function change_proxy(){
        //echo shell_exec("anonsurf changeid");
    }

    public function change_cse(){
        $random_token = Assets\Engines::google_token();
        $random_google = Assets\Engines::google_random();
        $random_google = str_replace("www", "cse", $random_googCle);
        $this->request_target = array($random_google."/cse?cx=".$random_token."&q=".Modules\Scanner::$dork."num=10&safe=off&start=".Modules\Scanner::$page);
    }

    public function request(){
        $this->request_init = curl_multi_init();
        $targets = is_array($this->request_target) ? $this->request_target : array($this->request_target);
        foreach($targets as $t => $target) {
            $target = str_replace(" ", "%20", $target);
            $this->request_urls[$t] = curl_init($target);
            curl_setopt_array($this->request_urls[$t], $this->request_opts);
            curl_multi_add_handle($this->request_init, $this->request_urls[$t]);
        }
        $running = NULL;
        do {
            usleep(100);
            curl_multi_exec($this->request_init, $running);
        } while ($running > 0);
        $ret = array();
        foreach ($targets as $t => $target) {
            $ret[0] = curl_multi_getcontent($this->request_urls[$t]);
            $ret[1] = curl_getinfo($this->request_urls[$t]);
            $ret[2] = curl_error($this->request_urls[$t]);
        }
        foreach ($targets as $t => $target) {
            curl_multi_remove_handle($this->request_init, $this->request_urls[$t]);
        }
        curl_multi_close($this->request_init);
        Core\Core::unlinker();
        unset($this->request_urls);    
        self::$last_code = $ret[1]['http_code'];
        self::$result = array('corpo' => $ret[0], 'server' => $ret[1], 'error' => $ret[2]);
    }

    function __destruct(){} // destroy data
}
?>
