<?php

namespace Indorker\Core;

use Indorker\Core\Modules\Controls as Controls;
use Indorker\Core\Assets as Assets;;



class Core
{
    private static array $structures = array(
                                    'Library' => '/assets/library.php',
                                    'Configs' => '/assets/config.php',
                                    'Session' => '/assets/session.php',
                                    'Assets' => '/assets/asset.php',
                                    'Engines' => '/assets/engines.php',
                                    'UserAgents' => '/assets/useragent.php',
                                    'Headers' => '/assets/headers.php',
                                    'Referer' => '/assets/referer.php',
                                    'Options' => '/modules/controls/options.php',
                                    'Helps' => '/modules/controls/helps.php',
                                    'Update' => '/modules/controls/update.php',
                                    'Connection' => '/modules/connection.php',
                                    'Settings' => '/modules/settings.php',
                                    'Request' => '/modules/request.php',
                                    'Finder' => '/modules/finder.php',
                                    'Scanner' => '/modules/scanner.php',
                                    'Crawler' => '/modules/crawler.php',
                                    'Bypasser' => '/modules/bypasser.php');
    private function loader(){
        sleep(1);
        print("\n===[: Loading Modules :]\n");
        foreach(self::$structures as $struct => $s){
            $file = __DIR__.$s;
            if(file_exists($file)){
                require_once($file);
                //sleep(1);
                print(".");
            }else{
                print("ERRORE MODULO: ".$file);
            }
        }
        system('clear');
    }

    public static function unlinker(){
        unlink('cookie.txt');
    }

    public function start()
    {
        $this->loader();
        /*Library::check_dependencies(); // CHECK DEPENDENCIES
        Update::check_update();*/
        Assets\Config::set_configs(); // RUN CONFIGS
        Assets\Session::start_session(); // RUN SESSION
        $this->main();// RUN MAIN
        $this->stop();
    }

    public function main(){
        print("\n\n
       
         WASS - Web Automatic Search Scanner
        ######################################
        ## - Version: 0.1 BETA              ##
        ## - Author: FishX                  ##
        ## - Github: FishDevLab             ##
        ######################################
               <<< --help, --update >>>
        \n");
        sleep(0.3);
        Controls\Options::ctrl_options();
        sleep(0.1);
    }

    protected function stop()
    {
        Assets\Session::stop_session();
    }
}

?>
