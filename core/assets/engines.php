<?php

namespace Indorker\Core\Assets;

class Engines
{
    public static array $engines = array(
                                "0" => array(
                                    'id' => 0,
                                    'engine' => "GOOGLE IT",
                                    'alias' => "www.google.it",
                                    'host' => "https://www.google.it/",
                                    'url' => "search?q=<SEARCH>&start=<PAGE>",
                                    'method' => "GET",
                                    'record' => 50
                                ),
                                "1" => array(
                                    'id' => 1,
                                    'engine' => "GOOGLE COM",
                                    'alias' => "www.google.com",
                                    'host' => "https://www.google.com/",
                                    'url' => "search?q=<SEARCH>&start=<PAGE>",
                                    'method' => "GET",
                                    'record' => 100
                                ),
                                
                                "2" => array(
                                    'id' => 2,
                                    'engine' => "BING",
                                    'alias' => "www.bing.com",
                                    'host' => "https://www.bing.com/",
                                    'url' => "search?q=<SEARCH>&first=<PAGE>",
                                    'method' => "GET",
                                    'page_increment' => 11,
                                    'page_limit' => 333,
                                    'record' => 0
                                ));

    public static array $google_domains = array(
                                    'www.google.com', 'www.google.ac', 'www.google.com.om',
                                    'www.google.ad', 'www.google.ae', 'www.google.com.af',
                                    'www.google.com.ag', 'www.google.com.ai', 'www.google.am',
                                    'www.google.it.ao', 'www.google.com.ar', 'www.google.cat',
                                    'www.google.as', 'www.google.at', 'www.google.com.au',
                                    'www.google.az', 'www.google.ba', 'www.google.com.bd',
                                    'www.google.be', 'www.google.bf', 'www.google.bg',
                                    'www.google.com.bh', 'www.google.bi', 'www.google.bj',
                                    'www.google.com.bn', 'www.google.com.bo', 'www.google.com.br',
                                    'www.google.bs', 'www.google.co.bw', 'www.google.com.by',
                                    'www.google.com.bz', 'www.google.ca', 'www.google.com.kh',
                                    'www.google.cc', 'www.google.cd', 'www.google.cf',
                                    'www.google.com.co', 'www.google.co.nz',
                                    'www.google.cg', 'www.google.ch', 'www.google.ci',
                                    'www.google.co.ck', 'www.google.cl', 'www.google.cm',
                                    'www.google.co.cr', 'www.google.com.cu', 'www.google.cv',
                                    'www.google.cz', 'www.google.de', 'www.google.nu',
                                    'www.google.dj', 'www.google.dk', 'www.google.dm',
                                    'www.google.com.do', 'www.google.dz', 'www.google.no',
                                    'www.google.com.ec', 'www.google.ee', 'www.google.com.eg',
                                    'www.google.es', 'www.google.com.et', 'www.google.com.np',
                                    'www.google.fi', 'www.google.com.fj', 'www.google.fm',
                                    'www.google.fr', 'www.google.ga', 'www.google.nl',
                                    'www.google.ge', 'www.google.gf', 'www.google.gg',
                                    'www.google.com.gh', 'www.google.com.gi', 'www.google.nr',
                                    'www.google.gl', 'www.google.gm', 'www.google.gp',
                                    'www.google.gr', 'www.google.com.gt', 'www.google.com.ni',
                                    'www.google.gy', 'www.google.com.hk', 'www.google.hn',
                                    'www.google.hr', 'www.google.ht', 'www.google.com.ng',
                                    'www.google.hu', 'www.google.co.id', 'www.google.iq',
                                    'www.google.ie', 'www.google.co.il', 'www.google.com.nf',
                                    'www.google.im', 'www.google.co.in', 'www.google.io',
                                    'www.google.is', 'www.google.it', 'www.google.ne',
                                    'www.google.je', 'www.google.com.jm', 'www.google.jo',
                                    'www.google.co.jp', 'www.google.co.ke', 'www.google.com.na',
                                    'www.google.ki', 'www.google.kg', 'www.google.co.kr',
                                    'www.google.com.kw', 'www.google.kz', 'www.google.co.mz',
                                    'www.google.la', 'www.google.com.lb', 'www.google.com.lc',
                                    'www.google.li', 'www.google.lk', 'www.google.com.my',
                                    'www.google.co.ls', 'www.google.lt', 'www.google.lu',
                                    'www.google.lv', 'www.google.com.ly', 'www.google.com.mx',
                                    'www.google.co.ma', 'www.google.md', 'www.google.me',
                                    'www.google.mg', 'www.google.mk', 'www.google.mw',
                                    'www.google.ml', 'www.google.mn', 'www.google.ms',
                                    'www.google.com.mt', 'www.google.mu', 'www.google.mv',
                                    'www.google.com.pa', 'www.google.com.pe', 'www.google.com.ph',
                                    'www.google.com.pk', 'www.google.pn', 'www.google.com.pr',
                                    'www.google.ps', 'www.google.pt', 'www.google.com.py',
                                    'www.google.com.qa', 'www.google.ro', 'www.google.rs',
                                    'www.google.rw', 'www.google.com.sa',
                                    'www.google.com.sb', 'www.google.sc', 'www.google.se',
                                    'www.google.com.sg', 'www.google.sh', 'www.google.si',
                                    'www.google.sk', 'www.google.com.sl', 'www.google.sn',
                                    'www.google.sm', 'www.google.so', 'www.google.st',
                                    'www.google.com.sv', 'www.google.td', 'www.google.tg',
                                    'www.google.co.th', 'www.google.tk', 'www.google.tl',
                                    'www.google.tm', 'www.google.to', 'www.google.com.tn',
                                    'www.google.com.tr', 'www.google.tt', 'www.google.com.tw',
                                    'www.google.co.tz', 'www.google.com.ua', 'www.google.co.ug',
                                    'www.google.co.uk', 'www.google.us', 'www.google.com.uy',
                                    'www.google.co.uz', 'www.google.com.vc', 'www.google.co.ve',
                                    'www.google.vg', 'www.google.co.vi', 'www.google.com.vn',
                                    'www.google.vu', 'www.google.ws', 'www.google.co.za',
                                    'www.google.co.zm', 'www.google.co.zw'
                                );
                                
    public function google_random(){
        return 'https://'.self::$google_domains[rand(0, count(self::$google_domains) - 1)];
    }

    public function google_trix(){
        foreach(self::$google_domains as $dom){
            if(!strstr(".com", $dom)){
                return 'https://'.$dom;
            }else{
                break;
            }
        }
    }

    public function google_token(){
        $generic = array(
            '013269018370076798483:wdba3dlnxqm',
            '005911257635119896548:iiolgmwf2se',
            '007843865286850066037:b0heuatvay8',
            '002901626849897788481:cpnctza84gq',
            '006748068166572874491:55ez0c3j3ey',
            '012984904789461885316:oy3-mu17hxk',
            '006688160405527839966:yhpefuwybre',
            '003917828085772992913:gmoeray5sa8',
            '007843865286850066037:3ajwn2jlweq',
            '010479943387663786936:wjwf2xkhfmq',
            '012873187529719969291:yexdhbzntue',
            '012347377894689429761:wgkj5jn9ee4'
        );
        return $generic[rand(0, count($generic) - 1)];
    }
}
?>
