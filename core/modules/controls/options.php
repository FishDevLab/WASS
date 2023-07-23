<?php

namespace Indorker\Core\Modules\Controls;

use Indorker\Core\Assets as Assets;
use Indorker\Core\Modules as Modules;

class Options
{   
    
    public static array $engine = [];
    public static array $dork = [];
    public static array $finder;
    public static array $crawler;
    public static string $filter_dork ;
    private static $mode = "SFC";
    public static array $return_options;
    public static array $options = array(
        'help::','mode:','set-search:','set-engine:','set-finder:','filter-dork:'
    );

    public function ctrl_options(){
        self::$return_options = getopt('h::m:fd:', self::$options);

        if(!empty(self::$return_options)){
            if(isset(self::$return_options["help"]) || isset(self::$return_options["h"])){
                Help::help();
            }else{
                if(isset(self::$return_options["mode"])){
                    Options::read_options();
                    Options::set_mode(self::$return_options["mode"]);
                }else{
                    if(isset(self::$return_options["set-engine"]) && isset(self::$return_options["set-search"])){
                        Options::read_options();
                        Options::set_mode("SFC");
                    }else{
                        print("\n[-] NEED OPTIONS: CHOICE MODE AND SET BASIC OPTIONS (--mode) [-]");
                    }
                }   
            }
        }else{
            print("\n[-] NEED OPTIONS, USE --help COMMAND FOR VISIT OPTIONS");
            exit(0);
        }
    }

    private function read_options(){
        foreach(self::$return_options as $opt => $o){
            Options::set_options($opt, $o);
        }
    }

    private function set_options(string $opt, string $o){
        switch(true){
            case ($opt == "set-engine" || $opt == "e"):
                $opt_engine = explode(',',$o);
                sort($opt_engine);
                self::$engine = $opt_engine;
                break;
            case ($opt == "set-search" || $opt == "s"):
                $opt_dork = explode(",", $o);
                self::$dork = $opt_dork;
                break;
            case ($opt == "set-finder" || $opt == "sf"):
                self::$finder = explode("\n", file_get_contents(__DIR__."/".$o));
                break;
            case ($opt == "filter-dork" || $opt == "fd"):
                self::$filter_dork = $o;
                break;
            default:
                break;
        }
    }

    private function set_mode($in){
        switch(true){
            case($in == "S"): 
                if(isset(self::$return_options["set-engine"]) && isset(self::$return_options["set-search"])){
                    Options::mode_s();
                }else{
                    print("\n[!!!] THIS MODE NEED --set-engine and --set-search OPTIONS [!!!]");
                    exit(0);
                }
                break;
            case($in == "SF"): //Scanner->Finder->Crawler
                if(isset(self::$return_options["set-engine"]) && isset(self::$return_options["set-search"])){
                    Options::mode_sf();
                }else{
                    print("\n[!!!] THIS MODE NEED --set-engine and --set-search OPTIONS [!!!]");
                    exit(0);
                }
                break;
            case ($in == "FC"): // Finder->Crawler
                if(isset(self::$return_options["set-finder"]) && isset(self::$return_options["set-search"])){
                    Options::mode_fc();
                }else{
                    print("\n[!!!] THIS MODE NEED --set-finder <file.txt> OPTION [!!!]");
                    exit(0);
                }
                break;
            default:
                print("\n[-] OPTION CONTENT NOT VALID: S/SF/SFC/FC/C [-]").exit(0);
                
                break;
        }
    }
    public static function mode_s()
    {
        $scan = new Modules\Scanner(self::$dork,self::$engine);
        $scan -> scan();
        exit(0);
    }
    public static function mode_sf()
    {
        $scan = new Modules\Scanner(self::$dork,self::$engine);
        $scan -> scan();
        sleep(0.1);
        $find = new Modules\Finder(Modules\Scanner::$scan_result);
        $find -> find();
        exit(0);
    }
    public static function mode_fc()
    {
        $find = new Modules\Finder(self::$finder);
        $find -> find();
        sleep(0.1);
        $crawl = new Modules\Crawler(Modules\Finder::$find_result);
        $crawl -> crawl();
        exit(0);
    }




}

?>
