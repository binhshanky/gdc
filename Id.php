<? 
    $host = array('facebook.com','m.facebook.com','www.facebook.com','fb.com');
    $link = $_GET['fb'];
    $link = explode("/",$link);
    function curl($link){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link); 

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $agents = array(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36',
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36',
            'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36'
         
        );
        curl_setopt($ch,CURLOPT_USERAGENT,$agents[array_rand($agents)]);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($ch);
        
        echo curl_error($ch);
        if(curl_errno($ch)){
            return false;
        } else return $content;
        
        curl_close($ch);

    }
    if(in_array($link[2],$host)){
        set_time_limit(4);
        $link[3] = str_replace('profile.php?id=','',$link[3]); 
        $id = explode("#",explode("?",$link[3])[0])[0];
        $link = "https://www.facebook.com/".$id;
        $content = curl($link);
        if($content){
            $idfb = "";
            $s = strpos($content,'"entity_id":"');
            for ($i = $s; 1; ++$i){
                if($content[$i] == "}"){
                    break;
                } else {
                    $idfb .= $content[$i];
                        
                }
            }
            $idfb = str_replace('"entity_id":"', "",$idfb);
            $idfb = str_replace('"','',$idfb);
            echo $idfb;
        } else {
            echo "Không lấy được ID";
        }
        
        
        //echo $content;
    } else {
        echo "Không lấy được ID";
    }
