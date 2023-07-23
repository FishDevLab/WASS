<?php

namespace Indorker\Core\Modules\Controls;

use Indorker\Core\Assets as Assets;
use Indorker\Core\Modules as Modules;

class Help
{   
    public function help(){
        print("
            
        [#] Modalità:
        ------------------------------------------------------------------------------------
        !   --mode  S/SF/F   CHOICE 
                -[S] ONLY SCANNER  // use --engine and --search, add search opts if you want
                -[SF] SCANNER-FINDER use --engine and --search, add search and find opts if you want
                -[F] FINDER use --find-urls with file, add find and crawl opts if you want

        [#] Scanner:  
        ------------------------------------------------------------------------------------
        !!  --set-engine    -e      SELECT ENGINES TO SCAN FOR SEARCH
                -[0] GOOGLE IT    | -[6] QWANT
                -[1] GOOGLE COM   | -[7] ECOSIA
                -[2] BING         | -[8] OSCOBO
                -[3] YAHOO        | -[9] BAIDU
                -[4] ASK          | -[10] YANDEX
                -[5] DUCKDUCKGO   | -[11] DUCKDUCKGO

        !!  --set-search    -s      INSERT KEY TO SEARCH

            --page          -p

            --result        -r

            --filter-regex

            --filter-dork       Filter searching scanner with dork
                - The dork as be added in search queries of engines
                - Available: inurl/intext/intitle/site


        [#] Finder:
        ------------------------------------------------------------------------------------
            The Finder catch the url site founded by scanner and
            process urls with filter for ensure the result is what 
            exact you want search.
        
        !   --set-finder    -f  
                -
                -

            --add-blacklist         ADD SITE IN BLACKLIST

            --filter-redork         RE-FILTER SITES WITH DORKS
                - The Filter rematch with php code dork and nod with 
                  normal dork word query. 
                - Available: url/text/title/site

        [#] Connection:
        ------------------------------------------------------------------------------------  

            --method    -m      
        
            --delay     -d
            
            --timeout   -t  

            --header    -h

            --cookies   -c

            --referer   -r

            --usrgnt    -u

            --proxy

            --tor

        [#] Results:
        ------------------------------------------------------------------------------------  

            --method    -m      
        
            --delay     -d
            
            --timeout   -t  

        
        
        ");
        exit(0);
    }
}

?>
