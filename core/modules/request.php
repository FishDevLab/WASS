<?php

namespace Indorker\Core\Modules;

use Indorker\Core as Core;
use Indorker\Core\Assets as Assets;
use Indorker\Core\Modules as Modules;
use Indorker\Core\Modules\Controls as Controls;

class Request extends Settings
{

    protected $request_init;
    public array $request_targ;
    protected $request_urls;

    public static array $response;

    public function __construct(array $targets){
        $this->request_targ = $targets;
        $this->request_urls = array();
        $this->response = array();
    }

    public function start(){
        $this->request_init = curl_multi_init();
        foreach($this->request_targ as $t => $target) {
            echo "\n".$target."\n";
            $target = str_replace(" ","%20",$target);
            $this->request_urls[$t] = curl_init($target);
            curl_setopt_array($this->request_urls[$t], parent::$request_opts);
            //print("\n ===[ +++ === +++ ]::. ".$target."\n");
            //print_r(parent::$request_opts);
            curl_multi_add_handle($this->request_init, $this->request_urls[$t]);
        }
        $run=NULL;
        do {
            usleep(500);
            curl_multi_exec($this->request_init, $run);
        } while ($run > 0);
        $res = array();
        foreach ($this->request_targ as $t => $target) {
            $res[0] = curl_multi_getcontent($this->request_urls[$t]);
            $res[1] = curl_getinfo($this->request_urls[$t]);
        }
        foreach($this->request_targ as $t => $target){
            curl_multi_remove_handle($this->request_init, $this->request_urls[$t]);
        }
        flush();
        ob_flush();
        preg_match("/\<title.*\>(.*)\<\/title\>/isU", $res[0], $title);
        curl_multi_close($this->request_init);
        Core\Core::unlinker(); // unlink cookie file 
        unset($this->request_urls);    
        self::$response = array('html'=>$res[0],
                                'server'=>$res[1], 
                                'title' => $title);
        //print_r(self::$response);
    }
    public static function set_domain($dom){
        if(strtoupper($dom) == "RANDOM"){
            $target = $this->request_targ[0];
            $targ = explode('/s',$target);
            $random = Assets\Engines::google_random();
            $this->request_targ = array($random."/s".$targ[1]);
        }elseif(strstr(strtoupper("TRIX",$dom))){
            $target = $this->request_targ[0];
            $targ = explode('/s',$target);
            $random = Assets\Engines::google_random();
            $this->request_targ = array($random."/s".$targ[1]);
            echo $this->request_targ;
        }
    }
    public static function set_apidom(){
        $random_token = Assets\Engines::google_token();
        $random_google = Assets\Engines::google_random();
        $random_google = str_replace("www", "cse", $random_googCle);
        $this->request_targ = array($random_google."/cse?cx=".$random_token."&q=".Modules\Scanner::$dork."num=10&safe=off&start=".Modules\Scanner::$page);
    }

    public function __destruct(){

    }


}

?>
