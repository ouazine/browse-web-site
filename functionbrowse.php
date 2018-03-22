<?php   
   public function browse($url1){
        $i=0;
        $tab=array();
        $url = parse_url($url1);
        if(strstr($url['host'], "www.")){
            $pos2 =strrpos($url['host'], "www.");
            $rest = substr($url['host'], $pos2 + 4);
            $url=$url['host'];
        }else
        {
            $url=$url['host'];
        }
        if(!strstr($url, "/")){
            $url=$url."/";
        }
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $page = curl_exec($ch);;

//Recherche des liens

        preg_match_all('#<a href="(.*?)"(.*?)>#is',$page,$resultat,PREG_PATTERN_ORDER);

//Listage des liens trouvés

        foreach ($resultat[1] as $liens) {
            if(strstr($liens, ".html") || strstr($liens, ".php") ){

                if(!strstr($liens, $url)){
                    $liens="http://".$url.$liens;


                    $tab[$i]=$liens;

                    $i++;
                }

            }

        }

        return $tab;
    }
	?>