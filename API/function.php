<?php
  // Define a function
  function shorten($url, $custom = NULL, $format = "json"){
    $key = "YOURAPIKEYINHERE";  // You can get this in /user/settings
    $domain = "YOURSITEURL";  // Without Slash e.g http://bit.ly 
    
    // Validate Variables
    if(empty($key) || empty($domain)) return FALSE;
    
    // Build API URL
    $domain = $domain."/api?api=$api_key&url=".urlencode($url);
    if(!is_null($custom) $domain = $domain."&custom=$custom";
    
    // Get content
    $content = file_get_contents($api_url);
    
    // return output
    if($format == "text"){
      if($content){
        return $content;
      }    
    }else{
      $res= @json_decode($content,TRUE);
      if($res["error"]){
        return $res["msg"];
      }else{
        return $res["short"];
      }      
    }
  }

?>
