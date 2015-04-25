<?php
if (!function_exists('prr')){ function prr($str) { echo "<pre>"; print_r($str); echo "</pre>\r\n"; }}        
if (!function_exists('nsx_stripSlashes')){ function nsx_stripSlashes(&$value){$value = stripslashes($value);}}
if (!function_exists('nsx_fixSlashes')){ function nsx_fixSlashes(&$value){ while (strpos($value, '\\\\')!==false) $value = str_replace('\\\\','\\',$value);
   if (strpos($value, "\\'")!==false) $value = str_replace("\\'","'",$value); if (strpos($value, '\\"')!==false) $value = str_replace('\\"','"',$value);
}}
if (!function_exists('CutFromTo')){ function CutFromTo($string, $from, $to){$fstart = stripos($string, $from); $tmp = substr($string,$fstart+strlen($from)); $flen = stripos($tmp, $to);  return substr($tmp,0, $flen);}}
if (!function_exists('nsx_doEncode')){ function nsx_doEncode($string,$key='NSX') { $key = sha1($key); $strLen = strlen($string);$keyLen = strlen($key); $j = 0; $hash = '';
  for ($i = 0; $i < $strLen; $i++) { $ordStr = ord(substr($string,$i,1)); if ($j == $keyLen) $j = 0; $ordKey = ord(substr($key,$j,1)); $j++; $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));} return $hash;
}}
if (!function_exists('nsx_doDecode')){ function nsx_doDecode($string,$key='NSX') { $key = sha1($key); $keyLen = strlen($key); $hash = ''; $sX = str_split($string, 2560);
  foreach($sX as $ss){$j=0; $sA=str_split($ss, 2); foreach($sA as $oS){$oS=hexdec(base_convert(strrev($oS),36,16)); if ($j==$keyLen) $j=0; $oK=ord(substr($key,$j,1)); $j++; $hash.=chr($oS-$oK);}} return $hash;
}}
if (!function_exists('nxs_decodeEntitiesFull')){ function nxs_decodeEntitiesFull($string, $quotes = ENT_COMPAT, $charset = 'utf-8') {
  return html_entity_decode(preg_replace_callback('/&([a-zA-Z][a-zA-Z0-9]+);/', 'nxs_convertEntity', $string), $quotes, $charset); 
}}
if (!function_exists('nxs_substr')){ function nxs_substr($str, $start){ preg_match_all("/./su", $str, $ar);
   if(func_num_args() >= 3) { $end = func_get_arg(2); return join("",array_slice($ar[0],$start,$end)); } else return join("",array_slice($ar[0],$start));
}}
if (!function_exists('nxs_strLen')){ function nxs_strLen($str) { return count(str_split(utf8_decode($str))); }}
if (!function_exists('nxs_convertEntity')){ function nxs_convertEntity($matches, $destroy = true) {
  static $table = array('quot' => '&#34;','amp' => '&#38;','lt' => '&#60;','gt' => '&#62;','apos' => '&#39;','OElig' => '&#338;','oelig' => '&#339;','Scaron' => '&#352;','scaron' => '&#353;','Yuml' => '&#376;','circ' => '&#710;','tilde' => '&#732;','ensp' => '&#8194;','emsp' => '&#8195;','thinsp' => '&#8201;','zwnj' => '&#8204;','zwj' => '&#8205;','lrm' => '&#8206;','rlm' => '&#8207;','ndash' => '&#8211;','mdash' => '&#8212;','lsquo' => '&#8216;','rsquo' => '&#8217;','sbquo' => '&#8218;','ldquo' => '&#8220;','rdquo' => '&#8221;','bdquo' => '&#8222;','dagger' => '&#8224;','Dagger' => '&#8225;','permil' => '&#8240;','lsaquo' => '&#8249;','rsaquo' => '&#8250;','euro' => '&#8364;','fnof' => '&#402;','Alpha' => '&#913;','Beta' => '&#914;','Gamma' => '&#915;','Delta' => '&#916;','Epsilon' => '&#917;','Zeta' => '&#918;','Eta' => '&#919;','Theta' => '&#920;','Iota' => '&#921;','Kappa' => '&#922;','Lambda' => '&#923;','Mu' => '&#924;','Nu' => '&#925;','Xi' => '&#926;','Omicron' => '&#927;','Pi' => '&#928;','Rho' => '&#929;','Sigma' => '&#931;','Tau' => '&#932;','Upsilon' => '&#933;','Phi' => '&#934;','Chi' => '&#935;','Psi' => '&#936;','Omega' => '&#937;','alpha' => '&#945;','beta' => '&#946;','gamma' => '&#947;','delta' => '&#948;','epsilon' => '&#949;','zeta' => '&#950;','eta' => '&#951;','theta' => '&#952;','iota' => '&#953;','kappa' => '&#954;','lambda' => '&#955;','mu' => '&#956;','nu' => '&#957;','xi' => '&#958;','omicron' => '&#959;','pi' => '&#960;','rho' => '&#961;','sigmaf' => '&#962;','sigma' => '&#963;','tau' => '&#964;','upsilon' => '&#965;','phi' => '&#966;','chi' => '&#967;','psi' => '&#968;','omega' => '&#969;','thetasym' => '&#977;','upsih' => '&#978;','piv' => '&#982;','bull' => '&#8226;','hellip' => '&#8230;','prime' => '&#8242;','Prime' => '&#8243;','oline' => '&#8254;','frasl' => '&#8260;','weierp' => '&#8472;','image' => '&#8465;','real' => '&#8476;','trade' => '&#8482;','alefsym' => '&#8501;','larr' => '&#8592;','uarr' => '&#8593;','rarr' => '&#8594;','darr' => '&#8595;','harr' => '&#8596;','crarr' => '&#8629;','lArr' => '&#8656;','uArr' => '&#8657;','rArr' => '&#8658;','dArr' => '&#8659;','hArr' => '&#8660;','forall' => '&#8704;','part' => '&#8706;','exist' => '&#8707;','empty' => '&#8709;','nabla' => '&#8711;','isin' => '&#8712;','notin' => '&#8713;','ni' => '&#8715;','prod' => '&#8719;','sum' => '&#8721;','minus' => '&#8722;','lowast' => '&#8727;','radic' => '&#8730;','prop' => '&#8733;','infin' => '&#8734;','ang' => '&#8736;','and' => '&#8743;','or' => '&#8744;','cap' => '&#8745;','cup' => '&#8746;','int' => '&#8747;','there4' => '&#8756;','sim' => '&#8764;','cong' => '&#8773;','asymp' => '&#8776;','ne' => '&#8800;','equiv' => '&#8801;','le' => '&#8804;','ge' => '&#8805;','sub' => '&#8834;','sup' => '&#8835;','nsub' => '&#8836;','sube' => '&#8838;','supe' => '&#8839;','oplus' => '&#8853;','otimes' => '&#8855;','perp' => '&#8869;','sdot' => '&#8901;','lceil' => '&#8968;','rceil' => '&#8969;','lfloor' => '&#8970;','rfloor' => '&#8971;','lang' => '&#9001;','rang' => '&#9002;','loz' => '&#9674;','spades' => '&#9824;','clubs' => '&#9827;','hearts' => '&#9829;','diams' => '&#9830;','nbsp' => '&#160;','iexcl' => '&#161;','cent' => '&#162;','pound' => '&#163;','curren' => '&#164;','yen' => '&#165;','brvbar' => '&#166;','sect' => '&#167;','uml' => '&#168;','copy' => '&#169;','ordf' => '&#170;','laquo' => '&#171;','not' => '&#172;','shy' => '&#173;','reg' => '&#174;','macr' => '&#175;','deg' => '&#176;','plusmn' => '&#177;','sup2' => '&#178;','sup3' => '&#179;','acute' => '&#180;','micro' => '&#181;','para' => '&#182;','middot' => '&#183;','cedil' => '&#184;','sup1' => '&#185;','ordm' => '&#186;','raquo' => '&#187;','frac14' => '&#188;','frac12' => '&#189;','frac34' => '&#190;','iquest' => '&#191;','Agrave' => '&#192;','Aacute' => '&#193;','Acirc' => '&#194;','Atilde' => '&#195;','Auml' => '&#196;','Aring' => '&#197;','AElig' => '&#198;','Ccedil' => '&#199;','Egrave' => '&#200;','Eacute' => '&#201;','Ecirc' => '&#202;','Euml' => '&#203;','Igrave' => '&#204;','Iacute' => '&#205;','Icirc' => '&#206;','Iuml' => '&#207;','ETH' => '&#208;','Ntilde' => '&#209;','Ograve' => '&#210;','Oacute' => '&#211;','Ocirc' => '&#212;','Otilde' => '&#213;','Ouml' => '&#214;','times' => '&#215;','Oslash' => '&#216;','Ugrave' => '&#217;','Uacute' => '&#218;','Ucirc' => '&#219;','Uuml' => '&#220;','Yacute' => '&#221;','THORN' => '&#222;','szlig' => '&#223;','agrave' => '&#224;','aacute' => '&#225;','acirc' => '&#226;','atilde' => '&#227;','auml' => '&#228;','aring' => '&#229;','aelig' => '&#230;','ccedil' => '&#231;','egrave' => '&#232;','eacute' => '&#233;','ecirc' => '&#234;','euml' => '&#235;','igrave' => '&#236;','iacute' => '&#237;','icirc' => '&#238;','iuml' => '&#239;','eth' => '&#240;','ntilde' => '&#241;','ograve' => '&#242;','oacute' => '&#243;','ocirc' => '&#244;','otilde' => '&#245;','ouml' => '&#246;','divide' => '&#247;','oslash' => '&#248;','ugrave' => '&#249;','uacute' => '&#250;','ucirc' => '&#251;','uuml' => '&#252;','yacute' => '&#253;','thorn' => '&#254;','yuml' => '&#255;');
  if (isset($table[$matches[1]])) return $table[$matches[1]];
  // else 
  return $destroy ? '' : $matches[0];
}}
if (!function_exists('nxs_decodeEntities')){function nxs_decodeEntities($text) {
    $text= html_entity_decode($text,ENT_QUOTES,"ISO-8859-1"); #NOTE: UTF-8 does not work!
    $text= preg_replace('/&#(\d+);/me',"chr(\\1)",$text); #decimal notation
    $text= preg_replace('/&#x([a-f0-9]+);/mei',"chr(0x\\1)",$text);  #hex notation
    return $text;
}}
if (!function_exists('nsFindImgsInPost')){function nsFindImgsInPost($post, $advImgFnd=false) { global $ShownAds; if (isset($ShownAds)) $ShownAdsL = $ShownAds;  $postImgs = array();
  if ($advImgFnd) $postCntEx = apply_filters('the_content', $post->post_excerpt); else $postCntEx = $post->post_excerpt;   
  if ($advImgFnd) $postCnt = apply_filters('the_content', $post->post_content); else $postCnt = $post->post_content; 
  $postCnt = $postCntEx.$postCnt;
  //$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $postCnt, $matches ); if ($output === false){return false;} 
  //$postCnt = str_replace("'",'"',$postCnt); $output = preg_match_all( '/src="([^"]*)"/', $postCnt, $matches ); if ($output === false){return false;}
  $postCnt = str_replace("'",'"',$postCnt); $output = preg_match_all( '/< *img[^>]*src *= *["\']?([^"\']*)/i', $postCnt, $matches ); // prr($matches);  
  if ($output === false || $output == 0){ $vids = nsFindVidsInPost($post, $advImgFnd==false); if (count($vids)>0)  $postImgs[] = 'http://img.youtube.com/vi/'.$vids[0].'/0.jpg';  else return false;} 
    else { foreach ($matches[1] as $match) { if (!preg_match('/^https?:\/\//', $match ) ) $match = site_url( '/' ) . ltrim( $match, '/' ); $postImgs[] = $match;} if (isset($ShownAds)) $ShownAds = $ShownAdsL; }  
  return $postImgs;
}}


if (!function_exists('nsFindAudioInPost')){function nsFindAudioInPost($post, $raw=true) {  //### !!!   $raw=false Breaks ob_start() [ref.outcontrol]: Cannot use output buffering in output buffering display handlers - Investigate
  global $ShownAds; if (isset($ShownAds)) $ShownAdsL = $ShownAds; $postVids = array();
  if (is_object($post)) { if ($raw) $postCnt = $post->post_content; else $postCnt = apply_filters('the_content', $post->post_content); } else $postCnt = $post;
  $regex_pattern = "((https?|ftp|gopher|telnet|file|notes|ms-help):((//)|(\\\\))+[\w\d:#@%/;$()~_?\+-=\\\.&]*\.(mp3|aac|m4a))";
  $output = preg_match_all( $regex_pattern, $postCnt, $matches );  if ($output === false){return false;}    
  foreach ($matches[0] as $match) { $postAu[] = $match; } $postAu = array_unique($postAu); if (isset($ShownAds)) $ShownAds = $ShownAdsL; return $postAu;
}}
if (!function_exists('nsGetYTThumb')){function nsGetYTThumb($yt) {  
  $out = 'http://img.youtube.com/vi/'.$yt.'/maxresdefault.jpg'; $response  = wp_remote_get($out); 
  if (is_wp_error($response) || $response['response']['code']!='200' ) { $out = 'http://img.youtube.com/vi/'.$yt.'/sddefault.jpg';  
    $response  = wp_remote_get($out); if (is_wp_error($response) || $response['response']['code']!='200' ) $out = 'http://img.youtube.com/vi/'.$yt.'/0.jpg';
  } return $out;  
}}
if (!function_exists('nsFindVidsInPost')){function nsFindVidsInPost($post, $raw=true) {  //### !!!  $raw=false ## Breaks ob_start() [ref.outcontrol]: Cannot use output buffering in output buffering display handlers - Investigate
  global $ShownAds; if (isset($ShownAds)) $ShownAdsL = $ShownAds; $postVids = array();
  if (is_object($post)) { if ($raw) $postCnt = $post->post_content; else $postCnt = apply_filters('the_content', $post->post_content); } else $postCnt = $post; //prr($postCnt);
  $postCnt = preg_replace('/youtube.com\/vi\/(.*)\/(.*).jpg/isU', "youtube.com/v/$1/", $postCnt);  
  $output = preg_match_all( '@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?(#[a-z_.-][a-z0-9+\$_.-]*)?)*)@', $postCnt, $matches ); if ($output === false){return false;} 
  foreach ($matches[0] as $match) {  
     $output2 = preg_match_all( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"<>&?/ ]{11})%i', $match, $matches2 ); if ($output2 === false){return false;} 
     foreach ($matches2[1] as $match2) {  $match2 = trim($match2); if (strlen($match2)==11) $postVids[] = $match2;} 
     $output3 = preg_match_all( '/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $match, $matches3 );  if ($output3 === false){return false;} 
     foreach ($matches3[3] as $match3) {  $match3 = trim($match3); if (strlen($match3)==8) $postVids[] = $match3;} 
  } $postVids = array_unique($postVids); if (isset($ShownAds)) $ShownAds = $ShownAdsL; return $postVids;
}}
if (!function_exists('nsTrnc')){ function nsTrnc($string, $limit, $break=" ", $pad=" ...") { if(nxs_strLen($string) <= $limit) return $string; if(nxs_strLen($pad) >= $limit) return ''; $string = nxs_substr($string, 0, $limit-nxs_strLen($pad)); 
  $brLoc = strripos($string, $break);  if ($brLoc===false) return $string.$pad; else return nxs_substr($string, 0, $brLoc).$pad; 
}}
if (!function_exists('nsSubStrEl')){ function nsSubStrEl($string, $length, $end='...'){ if (strlen($string) > $length){ $length -= strlen($end); $string  = substr($string, 0, $length); $string .= $end; } return $string;}}

if (!function_exists('nxs_snapCleanHTML')){ function nxs_snapCleanHTML($html) { 
    $html = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $html); $html = preg_replace('/<!--(.*)-->/Uis', "", $html); return $html;
}}
if (!function_exists("nxs_getNXSHeaders")) {  function nxs_getNXSHeaders($ref='', $post=false){ $hdrsArr = array(); 
 $hdrsArr['Connection']='keep-alive'; $hdrsArr['Referer']=$ref;
 $hdrsArr['User-Agent']='Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.22 Safari/537.11';
 if($post) $hdrsArr['Content-Type']='application/x-www-form-urlencoded'; 
 $hdrsArr['Accept']='application/json, text/javascript, */*; q=0.01';  
 if (function_exists('gzdeflate')) $hdrsArr['Accept-Encoding']='gzip,deflate,sdch'; 
 $hdrsArr['Accept-Language']='en-US,en;q=0.8'; $hdrsArr['Accept-Charset']='ISO-8859-1,utf-8;q=0.7,*;q=0.3'; return $hdrsArr;
}}
if (!function_exists('nxs_chckRmImage')){function nxs_chckRmImage($url, $chType='head'){ if( ini_get('allow_url_fopen')=='1' && @getimagesize($url)!==false) return true;
  $hdrsArr = nxs_getNXSHeaders(); $nxsWPRemWhat = 'wp_remote_'.$chType; $rsp  = $nxsWPRemWhat($url, array('headers' => $hdrsArr));  
  if(is_wp_error($rsp)) { nxs_addToLogN('E', 'Error', 'IMAGE', '-=ERROR=- Server can\'t access it\'s own images. (Image URL: '.$url.') Most probably it\'s a DNS problem. Please contact your hosting provider. '.serialize($rsp), ''); return false; }
  if (is_array($rsp) && ($rsp['response']['code']=='200' || ( $rsp['response']['code']=='403' &&  $rsp['headers']['server']=='cloudflare-nginx') )) return true; 
    else { if ($chType=='head') { return  nxs_chckRmImage($url, 'get'); } else { nxs_addToLogN('E', 'Error', 'IMAGE', '-=ERROR=- Server can\'t access it\'s own images. (Image URL: '.$url.') Most probably it\'s a DNS problem. Please contact your hosting provider. '.serialize($rsp), $url); return false; }
    } 
}}
if (!function_exists('nxs_getPostImage')){ function nxs_getPostImage($postID, $size='large', $def='') { $imgURL = '';  global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; $options['sImg'] = (defined('NXSAPIVER') && NXSAPIVER == '2.15.11')?1:0; 
  if (empty($options['imgNoCheck']) || $options['imgNoCheck'] != '1') { $indx = rand(0, 2); 
    $iTstArr = array('https://www.bing.com/s/a/hpc12.png','https://www.apple.com/global/elements/flags/16x16/usa_2x.png','https://s.yimg.com/rz/l/yahoo_en-US_f_p_142x37.png'); 
    $imgURL = $iTstArr[$indx]; $res = nxs_chckRmImage($imgURL); $imgURL = ''; if (!$res) $options['imgNoCheck'] = '1'; } if ($options['sImg']==1) return $options['useSSLCert'].'/logo2.png';
  //## Featured Image from Specified Location
  if ((int)$postID>0 && isset($options['featImgLoc']) && $options['featImgLoc']!=='') {  $afiLoc= get_post_meta($postID, $options['featImgLoc'], true); 
    if (is_array($afiLoc) && $options['featImgLocArrPath']!='') { $cPath = $options['featImgLocArrPath'];
      while (strpos($cPath, '[')!==false){ $arrIt = CutFromTo($cPath, '[', ']'); $arrIt = str_replace("'", "", str_replace('"', '', $arrIt)); $afiLoc = $afiLoc[$arrIt]; $cPath = substr($cPath, strpos($cPath, ']'));}    
    } $imgURL = trim($options['featImgLocPrefix']).trim($afiLoc); if ($imgURL!='' && stripos($imgURL, 'http')===false) $imgURL =  home_url().$imgURL;
  }
  if ($imgURL!='' && $options['imgNoCheck']!='1' && nxs_chckRmImage($imgURL)==false) $imgURL = '';  if ($imgURL!='') return $imgURL;
  //## Featured Image
  if ($imgURL=='') { if ((int)$postID>0 && function_exists("get_post_thumbnail_id") && function_exists('has_post_thumbnail') && has_post_thumbnail($postID) ){ 
    $imgURL = wp_get_attachment_image_src(get_post_thumbnail_id($postID), $size); $imgURL = $imgURL[0]; if ((trim($imgURL)!='')  && substr($imgURL, 0, 4)!='http') $imgURL = site_url($imgURL);
  }} 
  if ($imgURL!='' && $options['imgNoCheck']!='1' && nxs_chckRmImage($imgURL)==false) $imgURL = ''; if ($imgURL!='') return $imgURL;  
  //## plugin/categories-images
  if ((int)$postID>0 && function_exists('z_taxonomy_image_url')) {  $post_categories = wp_get_post_categories( $postID );
    foreach($post_categories as $c){ $cat = get_category( $c );  $imgURL = trim(z_taxonomy_image_url($cat->term_id)); if ($imgURL!='') break; }
    if ($imgURL!='' && substr($imgURL, 0, 4)!='http') {
      $stURL = site_url(); if (substr($stURL, -1)=='/') $stURL = substr($stURL, 0, -1);  if ($imgURL!='') $imgURL = $stURL.$imgURL; 
    }
  }
  if ($imgURL!='' && $options['imgNoCheck']!='1' && nxs_chckRmImage($imgURL)==false) $imgURL = ''; if ($imgURL!='') return $imgURL;
  //## YAPB
  if ((int)$postID>0 && class_exists("YapbImage")) { $imgURLObj = YapbImage::getInstanceFromDb($postID); if (is_object($imgURLObj)) $imgURL = $imgURLObj->uri; 
    $stURL = site_url(); if (substr($stURL, -1)=='/') $stURL = substr($stURL, 0, -1);  if ($imgURL!='') $imgURL = $stURL.$imgURL; 
  }
  if ($imgURL!='' && $options['imgNoCheck']!='1' && nxs_chckRmImage($imgURL)==false) $imgURL = ''; if ($imgURL!='') return $imgURL;
  //## Find Images in Post
  if ((int)$postID>0 && $imgURL=='') {$post = get_post($postID); $imgsFromPost = nsFindImgsInPost($post, $options['useUnProc'] == '1'); if (is_array($imgsFromPost) && count($imgsFromPost)>0) $imgURL = $imgsFromPost[0]; } //echo "##".count($imgsFromPost); prr($imgsFromPost);
  if ($imgURL!='' && $options['imgNoCheck']!='1' && nxs_chckRmImage($imgURL)==false) $imgURL = ''; if ($imgURL!='') return $imgURL;
  //## Attachements
  if ((int)$postID>0 && $imgURL=='') { $attachments = get_posts(array('post_type' => 'attachment', 'posts_per_page' => -1, 'post_parent' => $postID)); 
      if (is_array($attachments) && count($attachments)>0 && is_object($attachments[0])) { $imgURL = wp_get_attachment_image_src($attachments[0]->ID, $size); $imgURL = $imgURL[0]; }     
  }
  if ($imgURL!='' && $options['imgNoCheck']!='1' && nxs_chckRmImage($imgURL)==false) $imgURL = ''; if ($imgURL!='') return $imgURL;    
  //## Default
  if (trim($imgURL)=='' && trim($def)=='') $imgURL = $options['ogImgDef']; 
  if (trim($imgURL)=='' && trim($def)!='') $imgURL = $def; 

  return $imgURL;
}}
if (!function_exists('nxs_makeURLParams')){ function nxs_makeURLParams($params) {  global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options;
    if (!isset($options['addURLParams']) || $options['addURLParams']=='') return false; else $templ = $options['addURLParams'];
    if (preg_match('%NTNAME%', $templ)) $templ = str_ireplace("%NTNAME%", urlencode($params['NTNAME']), $templ);
    if (preg_match('%NTCODE%', $templ)) $templ = str_ireplace("%NTCODE%", urlencode($params['NTCODE']), $templ);
    if (preg_match('%ACCNAME%', $templ)) $templ = str_ireplace("%ACCNAME%", urlencode($params['ACCNAME']), $templ);
    if (preg_match('%POSTID%', $templ)) $templ = str_ireplace("%POSTID%", urlencode($params['POSTID']), $templ);
    if (preg_match('%POSTTITLE%', $templ)) { $post = get_post($params['POSTID']); if (is_object($post)) {$postName = $post->post_title; $templ = str_ireplace("%POSTTITLE%", urlencode($postName), $templ);}}
    if (preg_match('%SITENAME%', $templ)) { $siteTitle = urlencode(htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES)); $templ = str_ireplace("%SITENAME%", $siteTitle, $templ); }
    return $templ;
}}

function nxs_tiny_mce_before_init($init) { global $tinymce_version; 
  if (substr($tinymce_version,0,1)<4) $init['setup'] = "function( ed ) { ed.onChange.add( function( ed, e ) {  nxs_updateGetImgsX( e );   }); }"; else
    $init['setup'] = "function(ed) {ed.on('NodeChange', function(e){nxs_updateGetImgsX(e);});}";     
    return $init;
}

//## CSS && JS
if (!function_exists("jsPostToSNAP")) { function jsPostToSNAP() {  global $nxs_snapAvNts, $nxs_plurl; ?>
    <script type="text/javascript" >  
    function nxs_updateGetImgsX(e){ }
    jQuery(document).on('change', '#content', function( e ) { nxs_updateGetImgsX( e ); });
    
    function nxs_updateGetImgsXX(e){ 
      var targetId = e.target.id; 
      var text = 'Kortinko';
      switch ( targetId ) {
         case 'content':
             text = jQuery('#content').val(); 
             break;
         case 'tinymce':
             if ( tinymce.activeEditor ) text = tinymce.activeEditor.getContent();
             break;
      }
      jQuery('.nxs_imgPrevList').html( text );
    }    
    function nxs_clPrvImgShow(tIdN){ jQuery("#isAutoImg-"+tIdN).trigger('click'); jQuery("#isAutoImg-"+tIdN).trigger('click');  }    
    function nxs_clPrvImg(id, ii){ jQuery("#imgToUse-"+ii).val(jQuery("#"+id+" img").attr('src')); jQuery(".nxs_prevIDiv"+ii+" .nxs_checkIcon").hide();
      jQuery(".nxs_prevIDiv"+ii).removeClass("nxs_chImg_selDiv"); jQuery(".nxs_prevIDiv"+ii+" img").removeClass("nxs_chImg_selImg"); 
      jQuery("#"+id+" img").addClass("nxs_chImg_selImg"); jQuery("#"+id).addClass("nxs_chImg_selDiv"); jQuery("#"+id+" .nxs_checkIcon").show();
    }    
    function nxs_getOriginalWidthOfImg(img_element) { var t = new Image();  t.src = (img_element.getAttribute ? img_element.getAttribute("src") : false) || img_element.src; /* alert(t.src+" | "+t.width); */ return t.width; }        
    function nxs_updateGetImgs(e){ 
        var textOut='';
        var tId = e.target.id; 
        var tIdN = tId.replace("isAutoImg-", "");
        if ( tinymce.activeEditor ) text = tinymce.activeEditor.getContent(); else text = jQuery('#content').val();                
        jQuery('#NS_SNAP_AddPostMetaTags').append('<div id="nxs_tempDivImgs" style="display: none;"></div>'); jQuery('#nxs_tempDivImgs').append(text);
        var textOutA = new Array(); var currSelImg =  jQuery("#imgToUse-"+tIdN).val();
                
        textOutA.push('http://cdn.gtln.us/img/nxs/noImgC.png');  
        //var fImg = jQuery('.attachment-post-thumbnail').attr('src'); if (fImg!='' && fImg!=undefined) { textOutA.push(fImg); if (currSelImg=='') currSelImg = fImg; }        
        var fImg = jQuery('#set-post-thumbnail > img').attr('src'); if (fImg!='' && fImg!=undefined) { textOutA.push(fImg); if (currSelImg=='') currSelImg = fImg; }        
        var fImg = jQuery('#yapbdiv img').attr('src'); if (fImg!='' && fImg!=undefined) { textOutA.push(fImg); if (currSelImg=='') currSelImg = fImg; }
        
        jQuery('#nxs_tempDivImgs img').each(function(){ var prWidth; prWidth = nxs_getOriginalWidthOfImg(this); if (prWidth!=1) textOutA.push(jQuery(this).attr('src'));  });                
        jQuery('#nxs_tempDivImgs').remove();
        var index;  for (index = 0; index < textOutA.length; ++index) { var isSel = currSelImg == textOutA[index] ? 'nxs_chImg_selImg' : ''; var isSelDisp = currSelImg == textOutA[index] ? 'style="display:block;"' : ''; 
          textOut = textOut + '<div class="nxs_prevIDiv'+tIdN+' nxs_prevImagesDiv" id="nxs_idiv'+tIdN+index+'" onclick="nxs_clPrvImg(\'nxs_idiv'+tIdN+index+'\', \''+tIdN+'\');"><img class="nxs_prevImages '+isSel+'" src="'+textOutA[index]+'"><div '+isSelDisp+' class="nxs_checkIcon"><div class="media-modal-icon"></div></div></div>'; 
        }
        jQuery('#imgPrevList-'+tIdN).html( textOut );
        if (jQuery('#'+tId).is(":checked")) jQuery('#imgPrevList-'+tIdN).hide(); else {  jQuery('#nxs_'+tIdN+'_idivD').hide(); jQuery('#imgPrevList-'+tIdN).show();  }
        
    }
    
    jQuery(document).on('change', '.isAutoURL', function( e ) {    var tId = e.target.id; var tIdN = tId.replace("isAutoURL-", "");
       if (jQuery('#'+tId).is(":checked")) jQuery('#isAutoURLFld-'+tIdN).hide(); else { jQuery('#isAutoURLFld-'+tIdN).show(); }
    });    
    jQuery(document).on('change', '.isAutoImg', function( e ) {   
        nxs_updateGetImgs( e );
    });    
    jQuery(document).on('change', '#wp-content-editor-container #conXXtent', function() {
        nxs_updateGetImgs();
    });
    jQuery(document).on('change', '#tinXXymce', function() {
        nxs_updateGetImgs();
    });       
    jQuery(document).ready(function($) {          
    <?php       
      foreach ($nxs_snapAvNts as $avNt) {?>
        jQuery('input#rePostTo<?php echo $avNt['code']; ?>_button').click(function() { var data = { action: 'rePostTo<?php echo $avNt['code']; ?>', id: jQuery('input#post_ID').val(), nid:jQuery(this).attr('alt'), _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}; callAjSNAP(data, '<?php echo $avNt['name']; ?>'); });
    <?php } 
     foreach ($nxs_snapAvNts as $avNt) {?>
        jQuery('input#riTo<?php echo $avNt['code']; ?>_button').click(function() { var data = { action: 'rePostTo<?php echo $avNt['code']; ?>', id: jQuery('input#post_ID').val(), ri:1, nid:jQuery(this).attr('alt'), _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}; callAjSNAP(data, '<?php echo $avNt['name']; ?>'); });
    <?php } ?>
       function callAjSNAP(data, label) { 
            var style = "position: fixed; display: none; z-index: 1000; top: 50%; left: 50%; background-color: #E8E8E8; border: 1px solid #555; padding: 15px; width: 350px; min-height: 80px; margin-left: -175px; margin-top: -40px; text-align: center; vertical-align: middle;";
            jQuery('body').append("<div id='test_results' style='" + style + "'></div>");
            jQuery('#test_results').html("<p>Sending update to "+label+"</p>" + "<p><img src='<?php echo $nxs_plurl; ?>img/ajax-loader-med.gif' /></p>");
            jQuery('#test_results').show();            
            jQuery.post(ajaxurl, data, function(response) { if (response=='') response = 'Message Posted';
                jQuery('#test_results').html('<p> ' + response + '</p>' +'<input type="button" class="button" name="results_ok_button" id="results_ok_button" value="OK" />');
                jQuery('#results_ok_button').click(remove_results);
            });            
        }        
        function remove_results() { jQuery("#results_ok_button").unbind("click");jQuery("#test_results").remove();
            if (typeof document.body.style.maxHeight == "undefined") { jQuery("body","html").css({height: "auto", width: "auto"}); jQuery("html").css("overflow","");}
            document.onkeydown = "";document.onkeyup = "";  return false;
        }
    });
    </script>    
    <?php
  }
}
if (!function_exists("nxs_jsPostToSNAP2")){ function nxs_jsPostToSNAP2() { global $nxs_snapAvNts, $nxs_snapThisPageUrl, $plgn_NS_SNAutoPoster; 
   if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
?>
            
<script type="text/javascript">   

 jQuery(function(){
    jQuery("form .categorydiv .selectit input:checkbox").click ( function(){ var nxs_isLocked = jQuery('#nxsLockIt').val(); if (nxs_isLocked=='1') return; 
       var thVal = jQuery(this).val();  if (!jQuery(this).is(":checked")) return;        
       
       var arr = [<?php if (!empty($options['exclCats'])) { $xarr = maybe_unserialize($options['exclCats']); if (is_array($xarr)) echo "'".implode("','", $xarr)."'"; } ?>];
       if ( jQuery.inArray(thVal, arr)>-1) jQuery('.nxsGrpDoChb').removeAttr('checked'); else jQuery(".nxsGrpDoChb[title='def']").attr('checked','checked');
       
       jQuery(".nxs_SC").each(function(index) { var cats = jQuery(this).val();  var catsA = cats.split(','); uqID = jQuery(this).attr('id'); uqID = uqID.replace("nxs_SC_", "do", "gi");
         if (jQuery.inArray(thVal, catsA)>-1)  jQuery('#'+uqID).attr('checked','checked')
        // alert( uqID + "|" + catsA +  "|" + thVal);  
       }); 
       
       jQuery(".nxs_TG").each(function(index) { var cats = jQuery(this).val();  var catsA = cats.split(','); uqID = jQuery(this).attr('id'); uqID = uqID.replace("nxs_TG_", "do", "gi");
         if (jQuery.inArray(thVal, catsA)>-1)  jQuery('#'+uqID).attr('checked','checked')
        // alert( uqID + "|" + catsA +  "|" + thVal);  
       });        
       
    });
  });
   
  function seFBA(pgID,fbAppID,fbAppSec){ var data = { pgID: pgID, action: 'nsAuthFBSv', _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}; 
    jQuery.post(ajaxurl, data, function(response) {  
      window.location = "https://www.facebook.com/dialog/oauth?client_id="+fbAppID+"&client_secret="+fbAppSec+"&scope=publish_stream,offline_access,read_stream,manage_pages&redirect_uri=<?php echo $nxs_snapThisPageUrl;?>";
    });                       
  }
  function doLic(){ var lk = jQuery('#eLic').val();  jQuery.post(ajaxurl,{lk:lk, action: 'nxsDoLic', id: 0, _wpnonce: jQuery('input#doLic_wpnonce').val()}, function(j){ 
      if (jQuery.trim(j)=='OK') window.location = "<?php echo $nxs_snapThisPageUrl; ?>"; else alert('<?php _e('Wrong key, please contact support', 'nxs_snap'); ?>');
    }, "html")
  }
  function testPost(nt, nid){ jQuery(".blnkg").hide(); <?php foreach ($nxs_snapAvNts as $avNt) {?>
    if (nt=='<?php echo $avNt['code']; ?>') { 
       var data = { action: 'rePostTo<?php echo $avNt['code']; ?>', id: 0, nid: nid, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}; callAjSNAP(data, '<?php echo $avNt['name']; ?>'); 
    }<?php } ?>
  }
  
  function nxs_doTabs(){
    jQuery('#nxsAPIUpd').dblclick(function() { doLic(); });
    //When page loads...
    jQuery(".nsx_tab_content").hide(); //Hide all content
    jQuery("ul.nsx_tabs > li:first-child").addClass("active").show(); //Activate first tab
    jQuery(".nsx_tab_container > .nsx_tab_content:first-child").show(); //Show first tab content

    //On Click Event
    jQuery("ul.nsx_tabs li").click(function() {
      jQuery(this).parent().children("li").removeClass("active"); //Remove any "active" class
      jQuery(this).addClass("active"); //Add "active" class to selected tab
      jQuery(this).parent().parent().children(".nsx_tab_container").children(".nsx_tab_content").hide(); //Hide all tab content    
      var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
      jQuery(activeTab).show(); //Fade in the active ID content
      return false;
    });
      
  }
  
  function nxs_doTabsInd(iid){    
    //When page loads...
    jQuery(iid+" .nsx_tab_content").hide(); //Hide all content
    jQuery(iid+" ul.nsx_tabs > li:first-child").addClass("active").show(); //Activate first tab
    jQuery(iid+" .nsx_tab_container > .nsx_tab_content:first-child").show(); //Show first tab content

    //On Click Event
    jQuery(iid+" ul.nsx_tabs li").click(function() {
      jQuery(this).parent().children("li").removeClass("active"); //Remove any "active" class
      jQuery(this).addClass("active"); //Add "active" class to selected tab
      jQuery(this).parent().parent().children(".nsx_tab_container").children(".nsx_tab_content").hide(); //Hide all tab content    
      var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
      jQuery(activeTab).show(); //Fade in the active ID content
      return false;
    });
      
  }
  
  function nxs_in_array(needle, haystack) { for(var i in haystack) { if(haystack[i] == needle) return true;} return false; }
  
 
  
  jQuery(document).ready(function() {    nxs_doTabs();
    //## Check for excluded Tags    
    var nxs_curTagsValue = []; jQuery('.the-tags').each(function() {if (jQuery(this).val()!='') nxs_curTagsValue[jQuery(this).attr('id')] = jQuery(this).val(); });
    jQuery(function () { setTimeout(nxs_checkTagsChangesX, 0.1); });
    
    function nxs_checkTagsChangesX() { var isChanged = false; var nxs_isLocked = jQuery('#nxsLockIt').val(); if (nxs_isLocked=='1') return;
      jQuery('.the-tags').each(function() {       
        currentValue = jQuery( this ).val(); currID = jQuery(this).attr('id');   //   console.log( currID );   
        if ((currentValue) && currentValue != nxs_curTagsValue[currID] && currentValue != '') isChanged = true;
      });          
      if (isChanged) { //## Changed
        jQuery('.the-tags').each(function() { if (jQuery(this).val()!='') nxs_curTagsValue[jQuery(this).attr('id')] = jQuery(this).val(); });
        var nxs_curTagsValueX = ''; var tValX = [];
        jQuery('.the-tags').each(function() { 
           var tVals = jQuery( this ).val().toLowerCase().split(","); var tID = jQuery( this ).attr('id').replace("tax-input-",""); 
           for(var ii in tVals) tValX.push(tID+"|"+jQuery.trim(tVals[ii])); 
        }); //  console.log( tValX );
        jQuery(".nxs_TG").each(function(index) { var cats = jQuery(this).val();  var catsA = cats.split(','); uqID = jQuery(this).attr('id'); uqID = uqID.replace("nxs_TG_", "do", "gi");
          // console.log( uqID ); console.log( JSON.stringify( catsA ) );
        for(var ii in catsA) { var tgVal = jQuery.trim(catsA[ii]);
          if (tgVal.indexOf("|")<1 && tgVal!="") tgVal = "post_tag|"+tgVal;
          if (tgVal!="" && jQuery.inArray(tgVal, tValX)>-1) {  jQuery('#'+uqID).attr('checked','checked'); }           
        }        
        });
      } setTimeout(nxs_checkTagsChangesX, 0.1);
    }
    
  });
</script>

<style type="text/css">
.NXSButton { background-color:#89c403;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #89c403), color-stop(1, #77a809) );
    background:-moz-linear-gradient( center top, #89c403 5%, #77a809 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#89c403', endColorstr='#77a809');    
    -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; border:1px solid #74b807; display:inline-block; color:#ffffff;
    font-family:Trebuchet MS; font-size:12px; font-weight:bold; padding:4px 5px;  text-decoration:none;  text-shadow:1px 1px 0px #528009;
}.NXSButton:hover {color:#ffffff; background-color:#77a809;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #77a809), color-stop(1, #89c403) );
    background:-moz-linear-gradient( center top, #77a809 5%, #89c403 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#77a809', endColorstr='#89c403');    
}.NXSButton:active {color:#ffffff; position:relative; top:1px;}.NXSButton:focus {color:#ffffff; position:relative; top:1px;} .nsBigText{font-size: 14px; color: #585858; font-weight: bold; display: inline;}
.NXSButtonB { background-color:#038bc4;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #038bc4), color-stop(1, #096aa8) );
    background:-moz-linear-gradient( center top, #038bc4 5%, #096aa8 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#038bc4', endColorstr='#096aa8');    
    -moz-border-radius:4px; -webkit-border-radius:4px; border-radius:4px; border:1px solid #077cb8; display:inline-block; color:#ffffff;
    font-family:Trebuchet MS; font-size:12px; font-weight:bold; padding:4px 5px;  text-decoration:none;  text-shadow:1px 1px 0px #095d80;
}.NXSButtonB:hover {color:#ffffff; background-color:#096aa8;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #096aa8), color-stop(1, #038bc4) );
    background:-moz-linear-gradient( center top, #096aa8 5%, #038bc4 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#096aa8', endColorstr='#038bc4');    
}.NXSButtonB:active {color:#ffffff; position:relative; top:1px;}.NXSButton:focus {color:#ffffff; position:relative; top:1px;} .nsBigText{font-size: 14px; color: #585858; font-weight: bold; display: inline;}
#nxs_ntType {width: 150px;}
#nsx_addNT {width: 600px;}
.nxsInfoMsg{  margin: 1px auto; padding: 3px 10px 3px 5px; border: 1px solid #ffea90;  background-color: #fdfae4; display: inline; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.blnkg{text-decoration:blink; font-size: 17px; color: #0CB107; font-weight: bold; display: inline;}

div.popShAtt { display: none; position: absolute; width: 600px; padding: 10px; background: #eeeeee; color: #000000; border: 1px solid #1a1a1a; font-size: 90%; }
.underdash {border-bottom: 1px #21759B dashed; text-decoration:none;}
.underdash a:hover {border-bottom: 1px #21759B dashed}

.nxsTHRow {vertical-align:top; padding-top:6px; text-align:right; width:80px; padding-right:10px;}

ul.nsx_tabs {margin: 0;padding: 0; margin-top:5px;float: left;list-style: none;height: 32px;border-bottom: 1px solid #999;border-left: 1px solid #999;width: 99%;}
ul.nsx_tabs li {float: left;margin: 0;padding: 0;height: 31px;line-height: 31px;border: 1px solid #999;border-left: none;margin-bottom: -1px;overflow: hidden;position: relative;background: #e0e0e0;}
ul.nsx_tabs li a {text-decoration: none;color: #000; display: block; font-size: 1.2em; padding: 0 20px; border: 1px solid #fff; outline: none;}
ul.nsx_tabs li a:hover { background: #ccc;}
html ul.nsx_tabs li.active, html ul.nsx_tabs li.active a:hover  { background: #fff; border-bottom: 1px solid #fff; }
.nsx_tab_container {border: 1px solid #999; border-top: none; overflow: hidden; clear: both; float: left; width: 99%; background: #fff;}
.nsx_tab_content {padding: 10px;}

.nxs_tls_cpt{width:100%; padding-bottom: 5px; padding-top: 10px;font-size: 16px; font-weight: bold;}
.nxs_tls_bd{width:100%; padding-left: 10px; padding-bottom: 10px;}
.nxs_tls_sbInfo{font-style: italic; padding-bottom: 10px; padding-top: 2px;}
.nxs_tls_sbInfo2{font-style: italic; padding-left: 10px; padding-bottom: 5px; line-height: 10px; font-size: 11px;}
.nxs_tls_lbl{width:100%;padding-top:7px;padding-bottom:1px;}
.nxsInstrSpan{ font-size: 11px; }


.subDiv{margin-left: 15px;}
.nxs_hili {color:#008000;}
.clNewNTSets{width: 800px;}
.nxclear {clear: both;}

.nxs_icon16 { font-size: 14px; line-height: 18px;
    background-position: 3px 50% !important;
    background-repeat: no-repeat !important;
    display: inline-block;
    padding: 1px 0 1px 23px !important;
}

.nxs_box{border-color: #DFDFDF; border-radius: 3px 3px 3px 3px; box-shadow: 0 1px 0 #FFFFFF inset; border-style: solid; border-width: 1px; line-height: 1; margin-bottom: 10px; padding: 0; /* max-width: 1080px; */}
.nxs_box_header{border-bottom-color: #DFDFDF; box-shadow: 0 1px 0 #FFFFFF; text-shadow: 0 1px 0 #FFFFFF;font-size: 15px;font-weight: normal;line-height: 1;margin: 0;padding: 6px;
background:#f1f1f1;background-image:-webkit-gradient(linear,left bottom,left top,from(#ececec),to(#f9f9f9));background-image:-webkit-linear-gradient(bottom,#ececec,#f9f9f9);background-image:-moz-linear-gradient(bottom,#ececec,#f9f9f9);background-image:-o-linear-gradient(bottom,#ececec,#f9f9f9);background-image:linear-gradient(to top,#ececec,#f9f9f9)
-moz-user-select: none;border-bottom-style: solid;border-bottom-width: 1px;}
.nxs_box_inside{line-height: 1.4em; padding: 10px;}
.nxs_box_inside input[type=text]{ padding: 5px; height: 24px; border: 1px solid #ACACAC;}
.nxs_box_inside .insOneDiv, #nsx_addNT .insOneDiv{max-width: 1020px; background-color: #f8f9f9; background-repeat: no-repeat; margin: 10px; border: 1px solid #808080; padding: 10px; display:none; overflow: hidden;}
.nxs_box_inside .itemDiv {margin:5px;margin-left:10px;}
.nxs_box_header h3 {font-size: 14px; margin-bottom: 2px; margin-top: 2px;}
.nxs_newLabel {font-size: 11px; color:red; padding-left: 5px; padding-right: 5px;}

.nxs_prevImagesDiv {border:1px solid #0f3c6d;  width:110px; height:110px; margin:3px; padding:3px; text-align:center; float:left; position: relative;}
.nxs_prevImages {padding:1px; max-height:100px; max-width:100px;}
.nxs_chImg_selDiv {border:1px solid #800000;}
.nxs_chImg_selImg {border:4px solid #800000;}
.nxs_checkIcon{position: absolute;}

.nxs_checkIcon{display:none; height:24px;width:24px;position:absolute;top:-7px;right:-7px;outline:0;border:1px solid #fff;border-radius:3px;box-shadow:0 0 0 1px rgba(0,0,0,0.4);background:#800000;background-image:-webkit-gradient(linear,left top,left bottom,from(#800000),to(#570000));background-image:-webkit-linear-gradient(top,#800000,#570000);background-image:-moz-linear-gradient(top,#800000,#570000);background-image:-o-linear-gradient(top,#800000,#570000);background-image:linear-gradient(to bottom,#800000,#570000)}
.nxs_checkIcon{ top:-5px; right: -3px; width: 15px; height: 15px; box-shadow:0 0 0 1px #800000;background:#800000;background-image:-webkit-gradient(linear,left top,left bottom,from(#800000),to(#570000));background-image:-webkit-linear-gradient(top,#800000,#570000);background-image:-moz-linear-gradient(top,#800000,#570000);background-image:-o-linear-gradient(top,#800000,#570000);background-image:linear-gradient(to bottom,#800000,#570000)}
.nxs_checkIcon div{background-position:-21px 0; width: 15px; height: 15px;}
/* #nxsDivWrap .postbox .inside {overflow: hidden;}  */
#nxsDivWrap .postbox .description {vertical-align: middle; color: #ACACAC;}  

.submitX {padding-top: 7px; padding-bottom: 5px;}
</style>
<?php }}

if (!function_exists('nxs_doShowHint')){ function nxs_doShowHint($t, $ex='', $wdth='79'){ ?>
<div id="<?php echo $t; ?>Hint" class="nxs_FRMTHint" style="font-size: 11px; margin: 2px; margin-top: 0px; padding:7px; border: 1px solid #C0C0C0; width: <?php echo $wdth; ?>%; background: #fff; display: none;"><span class="nxs_hili">%TITLE%</span> - <?php _e('Inserts the Title of the post', 'nxs_snap'); ?>, <span class="nxs_hili">%URL%</span> - <?php _e('Inserts the URL of the post', 'nxs_snap'); ?>, <span class="nxs_hili">%SURL%</span> - <?php _e('Inserts the <b>shortened URL</b> of your post', 'nxs_snap'); ?>, <span class="nxs_hili">%IMG%</span> - <?php _e('Inserts the featured image URL', 'nxs_snap'); ?>, <span class="nxs_hili">%EXCERPT%</span> - <?php _e('Inserts the excerpt of the post (processed)', 'nxs_snap'); ?>, <span class="nxs_hili">%RAWEXCERPT%</span> - <?php _e('Inserts the excerpt of the post (as typed)', 'nxs_snap'); ?>,  <span class="nxs_hili">%ANNOUNCE%</span> - <?php _e('Inserts the text till the &lt;!--more--&gt; tag or first N words of the post', 'nxs_snap'); ?>, <span class="nxs_hili">%FULLTEXT%</span> - <?php _e('Inserts the processed body(text) of the post', 'nxs_snap'); ?>, <span class="nxs_hili">%RAWTEXT%</span> - <?php _e('Inserts the body(text) of the post as typed', 'nxs_snap'); ?>, <span class="nxs_hili">%TAGS%</span> - <?php _e('Inserts post tags', 'nxs_snap'); ?>, <span class="nxs_hili">%CATS%</span> - <?php _e('Inserts post categories', 'nxs_snap'); ?>, <span class="nxs_hili">%HTAGS%</span> - <?php _e('Inserts post tags as hashtags', 'nxs_snap'); ?>, <span class="nxs_hili">%HCATS%</span> - <?php _e('Inserts post categories as hashtags', 'nxs_snap'); ?>, <span class="nxs_hili">%AUTHORNAME%</span> - <?php _e('Inserts the author\'s name', 'nxs_snap'); ?>, <span class="nxs_hili">%SITENAME%</span> - <?php _e('Inserts the the Blog/Site name', 'nxs_snap'); ?>. <?php echo $ex; ?></div>
<?php }}

if (!function_exists('nxs_doSMAS')){ function nxs_doSMAS($nType, $typeii) { ?><div id="do<?php echo $typeii; ?>Div" class="clNewNTSets" style="margin-left: 10px; display:none; "><div style="font-size: 15px; text-align: center;"><br/><br/>
<?php printf( __( 'You already have %s configured.  This plugin supports only one %s account. <br/><br/> Please consider getting <a target="_blank" href="http://www.nextscripts.com/social-networks-auto-poster-for-wp-multiple-accounts">Multiple Accounts Edition</a> if you would like to add another %s account for auto-posting.', 'nxs_snap' ), $nType, $nType, $nType );  ?>
</div></div><?php 
}}

if (!function_exists('nxs_snapCleanup')){ function nxs_snapCleanup($options){   global $nxs_snapAvNts; 
    foreach ($nxs_snapAvNts as $avNt) { if (!isset($options[$avNt['lcode']]) || count($options[$avNt['lcode']])>1) { $copt = ''; $t = '';
      if (isset($options[$avNt['lcode']]) && is_array($options[$avNt['lcode']])) $copt = array_values( $options[$avNt['lcode']] );  
      $t = (isset($copt[0]) && is_array($copt[0]) && count($copt[0]>2))?$copt[0]:''; $options[$avNt['lcode']] = array(); if ($t!='') $options[$avNt['lcode']][] = $t;
    }}
    return $options;
}}

if (!function_exists('nxs_html_to_utf8')){ function nxs_html_to_utf8 ($data){return preg_replace("/\\&\\#([0-9]{3,10})\\;/e", 'nxs__html_to_utf8("\\1")', $data); }}
if (!function_exists('nxs__html_to_utf8')){ function nxs__html_to_utf8 ($data){ if ($data > 127){ $i = 5; while (($i--) > 0){
  if ($data != ($a = $data % ($p = pow(64, $i)))){ 
    $ret = chr(base_convert(str_pad(str_repeat(1, $i + 1), 8, "0"), 2, 10) + (($data - $a) / $p)); for ($i; $i > 0; $i--) $ret .= chr(128 + ((($data % pow(64, $i)) - ($data % ($p = pow(64, $i - 1)))) / $p)); break; }
  }} else $ret = "&#$data;";
  return $ret;
}}
if (!function_exists("nxs_chArrVar")) { function nxs_chArrVar($arr, $varN, $varV){ return (isset($arr) && is_array($arr) && isset($arr[$varN]) && $arr[$varN]==$varV); }}
    
    
if (!function_exists("nxs_metaMarkAsPosted")) { function nxs_metaMarkAsPosted($postID, $nt, $did, $args=''){ $mpo =  get_post_meta($postID, 'snap'.$nt, true);  $mpo =  maybe_unserialize($mpo);
  //prr($postID); prr('snap'.$nt);  prr($mpo); echo "#####".$postID."|".$nt."|".$did."|".$args;
  if (!is_array($mpo)) $mpo = array(); if (!isset($mpo[$did]) || !is_array($mpo[$did])) $mpo[$did] = array();
  if ($args=='' || ( is_array($args) && isset($args['isPosted']) && $args['isPosted']=='1')) $mpo[$did]['isPosted'] = '1';  
  if (is_array($args) && isset($args['isPrePosted']) && $args['isPrePosted']==1) $mpo[$did]['isPrePosted'] = '1';  
  if (is_array($args) && isset($args['pgID'])) $mpo[$did]['pgID'] = $args['pgID'];  
  if (is_array($args) && isset($args['postURL'])) $mpo[$did]['postURL'] = $args['postURL'];  
  if (is_array($args) && isset($args['pDate'])) $mpo[$did]['pDate'] = $args['pDate'];  
  /*$mpo = mysql_real_escape_string(serialize($mpo)); */ delete_post_meta($postID, 'snap'.$nt); add_post_meta($postID, 'snap'.$nt, str_replace('\\','\\\\', serialize($mpo)));
}}
if (!function_exists('nxs_checkAddLogTable')){ function nxs_checkAddLogTable(){ global $nxs_tpWMPU, $wpdb; if($nxs_tpWMPU=='S') switch_to_blog(1);  
  $installed_ver = get_option( "nxs_log_db_table_version" ); if ($installed_ver=='1.1') return true;
  $table_name = $wpdb->prefix . "nxs_log";
  $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    act VARCHAR(255) DEFAULT '' NOT NULL,
    nt VARCHAR(255) DEFAULT '' NOT NULL,
    type VARCHAR(255) DEFAULT '' NOT NULL,
    msg text NOT NULL,    
    extInfo text NOT NULL,    
    UNIQUE KEY id (id)
  ) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); dbDelta($sql);
  delete_option("nxs_log_db_table_version"); add_option("nxs_log_db_table_version", '1.1');
  if($nxs_tpWMPU=='S') restore_current_blog();
}}
if (!function_exists('nxs_getnxsLog')){ function nxs_getnxsLog(){ global $nxs_tpWMPU, $wpdb; if($nxs_tpWMPU=='S') switch_to_blog(1);  
   $log = $wpdb->get_results( "SELECT * FROM ". $wpdb->prefix . "nxs_log ORDER BY id", ARRAY_A ); if (!is_array($log)) return array(); else return $log;
}}

if (!function_exists('nxs_addToLog')){ function nxs_addToLog ($type, $action, $nt, $msg=''){ nxs_addToLogN ($type, $action, $nt, $msg); }}
if (!function_exists('nxs_addToLogN')){ function nxs_addToLogN ($type, $action, $nt, $msg, $extInfo=''){ global $nxs_tpWMPU, $wpdb; if($nxs_tpWMPU=='S') switch_to_blog(1); 
  global $plgn_NS_SNAutoPoster; if (isset($plgn_NS_SNAutoPoster)) $options = $plgn_NS_SNAutoPoster->nxs_options;  if (!empty($options) && !empty($options['numLogRows'])) $numLogRows = $options['numLogRows']; else $numLogRows = 150;
  //## Skip if Minimal Only Setting
  if (isset($options['extDebug']) && $options['extDebug']=='2' && stripos($action, 'Skipped')!==false ) return; 
  
  $logItem = array('date'=>date_i18n('Y-m-d H:i:s'), 'act'=>$action, 'msg'=> strip_tags($msg), 'extInfo'=>$extInfo, 'type'=>$type, 'nt'=>$nt); 
  $nxDB = $wpdb->insert( $wpdb->prefix . "nxs_log", $logItem );  $lid = $wpdb->insert_id; $lid = $lid-$numLogRows;
  if ($lid>0) $wpdb->query( 'DELETE FROM '.$wpdb->prefix . 'nxs_log WHERE id<'.$lid );    
  
  if ($type=='E') { $log = maybe_unserialize(get_option('NSX_LogToEmail')); if (!is_array($log)) $log = array(); $log[] = $logItem;
         delete_option("NSX_LogToEmail"); add_option("NSX_LogToEmail", $log);
  }
  
  // $nxsDBLog = get_option('NS_SNAutoPosterLog'); $nxsDBLog = maybe_unserialize($nxsDBLog); if(!is_array($nxsDBLog)) $nxsDBLog = array(); $nxsDBLog[] = $logItem; $nxsDBLog = array_slice($nxsDBLog, -150);  
  // $res = update_option('NS_SNAutoPosterLog', ($nxsDBLog));   
  //delete_option('NS_SNAutoPosterLog'); add_option('NS_SNAutoPosterLog', ($nxsDBLog));   
  if($nxs_tpWMPU=='S') restore_current_blog(); 
}}



if (!function_exists('nxsMergeArraysOV')){function nxsMergeArraysOV($Arr1, $Arr2){
  foreach($Arr2 as $key => $value) { if(array_key_exists($key, $Arr1) && is_array($value)) $Arr1[$key] = nxsMergeArraysOV($Arr1[$key], $Arr2[$key]); else $Arr1[$key] = $value;} return $Arr1;
}}

if (!function_exists('nxs_MergeCookieArr')){function nxs_MergeCookieArr($ArrO, $ArrN){ $namesArr = array(); foreach($ArrO as $key => $value) { if (is_object($value)) $namesArr[$key] = $value->name; }             
  foreach($ArrN as $key => $value) { if (is_object($value) && $value->value!='deleted') { $isEx = array_search($value->name, $namesArr); if ($isEx===false) $ArrO[] = $value; else $ArrO[$isEx] = $value;}} return $ArrO;
}}

if (!function_exists('nxs_addPostingDelaySel')){function nxs_addPostingDelaySel($nt, $ii, $hrs=0, $min=0, $days=0){ 
  global $plgn_NS_SNAutoPoster, $nxs_plurl;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; if ($options['nxsHTDP']=='I') return 'Not Compatible with "Publish Immediately"';
  if (function_exists('nxs_doSMAS4')) return nxs_doSMAS4($nt, $ii, $hrs, $min, $days); else return '<br/>';
}}
if (!function_exists('nxs_addPostingDelaySelV3')){function nxs_addPostingDelaySelV3($nt, $ii, $hrs=0, $min=0, $days=0){ 
  if (function_exists('nxs_doSMAS4')) { ?> <div class="nxs_tls_cpt"><?php _e('Posting Delay', 'nxs_snap'); ?></div>  
    <div class="nxs_tls_bd"><?php  global $plgn_NS_SNAutoPoster, $nxs_plurl;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
      if ($options['nxsHTDP']=='I') _e('Not Compatible with "Publish Immediately"'); else  echo nxs_doSMAS4($nt, $ii, $hrs, $min, $days); ?></div>      
  <?php } else echo '<br/>';
}}
 

if (!function_exists("nxs_doQTrans")) { function nxs_doQTrans($txt, $lng=''){ $txt = str_ireplace('<3','&lt;3', $txt); $txt = str_ireplace('<(','&lt;(', $txt); //$txt = preg_replace('/\[caption\s[^\]]*\]/', '', $txt);
    $txt = preg_replace('/\[caption[\s]{0,}(.*?)\][\s]{0,}(<a[\s]{0,}.*?<\/a>)[\s]{0,}(.*?)\[\/caption\]/ims', '<p $1> $2 <snap class="wpimgcaption">$3</snap> </p>', $txt); // WP Image with Caption fix
    if (!function_exists("qtrans_split") || strpos($txt, '<!--:')===false ) return $txt; else {
        $tta = qtrans_split($txt); if ($lng!='') return $tta[$lng]; else return reset($tta);
    }
}}

if (!function_exists('nxs_addQTranslSel')){function nxs_addQTranslSel($nt, $ii, $selLng){  
  if (function_exists('nxs_doSMAS6')) return nxs_doSMAS6($nt, $ii, $selLng); else return '';  
}}

if (!function_exists("nxs_hideTip_ajax")) { function nxs_hideTip_ajax() {  check_ajax_referer('nxsSsPageWPN');   
   global $plgn_NS_SNAutoPoster, $nxs_plurl;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
   $options['hideTopTip'] = '1';    update_option($plgn_NS_SNAutoPoster->dbOptionsName, $options); $plgn_NS_SNAutoPoster->nxs_options = $options;
}}

if (!function_exists("nxs_mkShortURL")) { function nxs_mkShortURL($url, $postID=''){ $rurl = '';  global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options;
    if ($options['nxsURLShrtnr']=='B' && trim($options['bitlyUname']!='') && trim($options['bitlyAPIKey']!='')) {      
      $response  = wp_remote_get('http://api-ssl.bitly.com/v3/shorten?login='.$options['bitlyUname'].'&apiKey='.$options['bitlyAPIKey'].'&longUrl='.urlencode($url)); 
      if (is_wp_error($response)) {  nxs_addToLog('bit.ly', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; }
      $rtr = json_decode($response['body'],true);
      if ($rtr['status_code']=='200') $rurl = $rtr['data']['url'];
    } //echo "###".$rurl;
    if ($options['nxsURLShrtnr']=='A' && trim($options['adflyUname']!='') && trim($options['adflyAPIKey']!='')) {      
      $response  = wp_remote_get('http://api.adf.ly/api.php?key='.$options['adflyAPIKey'].'&uid='.$options['adflyUname'].'&advert_type=int&domain='.$options['adflyDomain'].'&url='.urlencode($url));       
      if (is_wp_error($response)) {  nxs_addToLog('adf.ly', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; }     
      if ( $response['body']!='error')  $rurl = $response['body']; else {  nxs_addToLog('adf.ly', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; }
    }
    if ($options['nxsURLShrtnr']=='W' && function_exists('wp_get_shortlink')) { global $post; $post = get_post($postID);  $rurl = wp_get_shortlink($postID, 'post'); }
   
    if ($options['nxsURLShrtnr']=='Y' && trim($options['YOURLSKey']!='') && trim($options['YOURLSURL']!='')) { 

      $response  = wp_remote_get(($options['YOURLSURL']."?api={$options['YOURLSKey']}&url=".urlencode($url))); 
      if (is_wp_error($response)) {  nxs_addToLog('goo.gl', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; } 
      $rtr = json_decode($response,true);  if (!is_array($rtr) || !isset($rtr['short']) ) {  nxs_addToLog('goo.gl', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; }      
      $rurl = $rtr['short'];
    
    }  

    if ($options['nxsURLShrtnr']=='O' || $options['nxsURLShrtnr']=='' || $options['nxsURLShrtnr']=='G') {   
      $response  = wp_remote_post('https://www.googleapis.com/urlshortener/v1/url'.($options['gglAPIKey']!=''?'?key='.$options['gglAPIKey']:''), array('headers' => array('Content-Type'=>'application/json'), 'body' => '{"longUrl": "'.$url.'"}')); 
      if (is_wp_error($response)) {  nxs_addToLog('goo.gl', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; } 
      $rtr = json_decode($response['body'],true); if (!is_array($rtr) || isset($rtr['error']) || !isset($rtr['id']) ) {  nxs_addToLog('goo.gl', 'E', '-=ERROR=- '.print_r($response, true), ''); return $url; }      
      $rurl = $rtr['id'];
    }    
    //if ($rurl=='') { $response  = wp_remote_get('http://gd.is/gtq/'.$url); if ((is_array($response) && ($response['response']['code']=='200'))) $rurl = $response['body']; }
    if ($rurl!='') $url = $rurl;  return $url;
}}
//## Comments - DISQUS native function has global $post; overwriting $post parameter in the middle of it.
function nxs_dsq_export_wp($nxPost, $comments=null) { global $wpdb, $wp_query, $post; $post = $nxPost;  ob_start(); echo '<?xml version="1.0" encoding="' . get_bloginfo('charset') . '"?' . ">\n";?>
  <?php the_generator('export');?><rss version="2.0" xmlns:excerpt="http://wordpress.org/export/<?php echo WXR_VERSION; ?>/excerpt/" xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:dsq="http://www.disqus.com/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:wp="http://wordpress.org/export/<?php echo WXR_VERSION; ?>/">
  <channel>
    <title><?php bloginfo_rss('name'); ?></title><link><?php bloginfo_rss('url') ?></link><pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></pubDate>
    <generator>WordPress <?php bloginfo_rss('version'); ?>; Disqus <?php echo DISQUS_VERSION; ?></generator>
  <?php $wp_query->in_the_loop = true; setup_postdata($post); ?>
  <item><title><?php echo apply_filters('the_title_rss', $post->post_title); ?></title><link><?php the_permalink_rss() ?></link>
  <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
  <dc:creator><?php echo dsq_export_wxr_cdata(get_the_author()); ?></dc:creator>
  <guid isPermaLink="false"><?php the_guid(); ?></guid>
  <content:encoded><?php echo dsq_export_wxr_cdata( apply_filters('the_content_export', $post->post_content) ); ?></content:encoded>
  <dsq:thread_identifier><?php echo dsq_identifier_for_post($post); ?></dsq:thread_identifier>
  <wp:post_id><?php echo $post->ID; ?></wp:post_id>
  <wp:post_date_gmt><?php echo $post->post_date_gmt; ?></wp:post_date_gmt>
  <wp:comment_status><?php echo $post->comment_status; ?></wp:comment_status>
  <?php
  if ( $comments ) { foreach ( $comments as $c ) { ?>
    <wp:comment>
    <wp:comment_id><?php echo $c->comment_ID; ?></wp:comment_id>
    <wp:comment_author><?php echo dsq_export_wxr_cdata($c->comment_author); ?></wp:comment_author>
    <wp:comment_author_email><?php echo $c->comment_author_email; ?></wp:comment_author_email>
    <wp:comment_author_url><?php echo $c->comment_author_url; ?></wp:comment_author_url>
    <wp:comment_author_IP><?php echo $c->comment_author_IP; ?></wp:comment_author_IP>
    <wp:comment_date><?php echo $c->comment_date; ?></wp:comment_date>
    <wp:comment_date_gmt><?php echo $c->comment_date_gmt; ?></wp:comment_date_gmt>
    <wp:comment_content><?php echo dsq_export_wxr_cdata($c->comment_content) ?></wp:comment_content>
    <wp:comment_approved><?php echo $c->comment_approved; ?></wp:comment_approved>
    <wp:comment_type><?php echo $c->comment_type; ?></wp:comment_type>
    <wp:comment_parent><?php echo $c->comment_parent; ?></wp:comment_parent>
    </wp:comment>
  <?php } } // comments ?>
    </item>
  </channel>
  </rss>
  <?php $output = ob_get_clean(); return $output;
}
//## 
if (!function_exists("nxs_postNewComment")) { function nxs_postNewComment($cmnt, $aa = false) { $cmnt['comment_post_ID'] = (int) $cmnt['comment_post_ID'];
  $cmnt['comment_parent'] = isset($cmnt['comment_parent']) ? absint($cmnt['comment_parent']) : 0; $ae =  get_option('admin_email');
  //$u = get_user_by( 'email', get_option('admin_email') );   $cmnt['user_id'] = $u->ID; //???
  $u = get_user_by( 'email', $cmnt['comment_author_email'] ); if (!empty($u)) $cmnt['user_id'] = $u->ID; else $cmnt['user_id'] = 0;

  $parent_status = ( 0 < $cmnt['comment_parent'] ) ? wp_get_comment_status($cmnt['comment_parent']) : ''; 
  $cmnt['comment_parent'] = ( 'approved' == $parent_status || 'unapproved' == $parent_status ) ? $cmnt['comment_parent'] : 0;
  $cmnt['comment_author_IP'] = ''; if (empty($cmnt['comment_agent'])) $cmnt['comment_agent'] = 'SNAP'; $cmnt['comment_date'] =  get_date_from_gmt( $cmnt['comment_date_gmt'] );    
  $cmnt = wp_filter_comment($cmnt); if ($aa) $cmnt['comment_approved'] = 1; else $cmnt['comment_approved'] = nxs_wp_allow_comment($cmnt); // echo "INSERT";  prr($cmnt);
  if ( $cmnt['comment_approved'] != 'spam' && $cmnt['comment_approved']>1 ) return $cmnt['comment_approved'];  else  $cmntID = wp_insert_comment($cmnt); 
  if (empty($cmntID)) {  nxs_addToLogN('E', 'Error', 'Comments', '-=ERROR=-', print_r($cmnt, true)); return; }
  
  if ( 'spam' !== $cmnt['comment_approved'] ) { if ( '0' == $cmnt['comment_approved'] ) wp_notify_moderator($cmntID); $post = &get_post($cmnt['comment_post_ID']);
    if ( get_option('comments_notify') && $cmnt['comment_approved'] && ( ! isset( $cmnt['user_id'] ) || $post->post_author != $cmnt['user_id'] ) ) wp_notify_postauthor($cmntID, isset( $cmnt['comment_type'] ) ? $cmnt['comment_type'] : '' );  
    global $wpdb, $dsq_api;
    if (isset($dsq_api) && is_object($post)) { $plugins_url = str_replace( 'social-networks-auto-poster-facebook-twitter-g/', '', plugin_dir_path( __FILE__ )); require_once( $plugins_url.'disqus-comment-system/export.php'); 
    if (function_exists('dsq_export_wp')) {
      $comments = $wpdb->get_results( $wpdb->prepare("SELECT * FROM $wpdb->comments WHERE comment_ID = %d", $cmntID) ); 
      $wxr = nxs_dsq_export_wp($post, $comments); $response = $dsq_api->import_wordpress_comments($wxr, time()); 
    }}
  } 
  return $cmntID;
}}

//#### Native WP Function that has wp_die in the middle of it ?????
function nxs_wp_allow_comment($commentdata) { global $wpdb; extract($commentdata, EXTR_SKIP); 
    // Simple duplicate check // expected_slashed ($comment_post_ID, $comment_author, $comment_author_email, $comment_content)
    $dupe = "SELECT comment_ID FROM $wpdb->comments WHERE comment_post_ID = '$comment_post_ID' AND comment_parent = '$comment_parent' AND comment_approved != 'trash' AND ( comment_author = '$comment_author' ";
    if ( $comment_author_email ) $dupe .= "OR comment_author_email = '$comment_author_email' "; $dupe .= ") AND comment_content = '$comment_content' LIMIT 1";
    $dupeID = $wpdb->get_var($dupe); if ( $dupeID ) { do_action( 'comment_duplicate_trigger', $commentdata ); return $dupeID; } 
    do_action( 'check_comment_flood', $comment_author_IP, $comment_author_email, $comment_date_gmt );
    if ( ! empty( $user_id ) ) { $user = get_userdata( $user_id ); $post_author = $wpdb->get_var($wpdb->prepare("SELECT post_author FROM $wpdb->posts WHERE ID = %d LIMIT 1", $comment_post_ID)); }
    if ( isset( $user ) && ( $user_id == $post_author || $user->has_cap( 'moderate_comments' ) ) ) { // The author and the admins get respect.
        $approved = 1;
     } else { // Everyone else's comments will be checked.
        if ( check_comment($comment_author, $comment_author_email, $comment_author_url, $comment_content, $comment_author_IP, $comment_agent, $comment_type) ) $approved = 1; else $approved = 0;
        if ( wp_blacklist_check($comment_author, $comment_author_email, $comment_author_url, $comment_content, $comment_author_IP, $comment_agent) ) $approved = 'spam';
    } $approved = apply_filters( 'pre_comment_approved', $approved, $commentdata ); return $approved;
}

if (!function_exists("ns_get_avatar")) { function ns_get_avatar($avatar, $id_or_email, $size=96, $default='', $alt='') { 
    if ( is_object($id_or_email) ) { 
      if ($id_or_email->comment_agent=='SNAP' && stripos($id_or_email->comment_author_url, 'facebook.com')!==false) { $fbuID = str_ireplace('@facebook.com','',$id_or_email->comment_author_email);
        $avatar = "<img alt='{$id_or_email->comment_author}' src='https://graph.facebook.com/$fbuID/picture' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";        
      }
      if (stripos($id_or_email->comment_agent, 'SNAP||')!==false && stripos($id_or_email->comment_author_url, 'twitter.com')!==false) { $fbuID = str_ireplace('SNAP||','',$id_or_email->comment_agent);
        $avatar = "<img alt='{$id_or_email->comment_author}' src='{$fbuID}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";        
      }
      
    }
    return $avatar;
}}

if (!function_exists('nxs_doProcessTags')){ function nxs_doProcessTags($tags){ $tagsA = array(); if (!is_array($tags)) { $tags = explode(',', $tags); 
  foreach ($tags as $tg) $tagsA[] = trim($tg); } else $tagsA = $tags; $tagsA = array_unique($tagsA);  $tags = array(); 
  foreach ($tagsA as $tg) { $tags['tagsA'][] = $tg; $tags['htagsA'][] = "#".trim(str_replace(' ', '', preg_replace('/[^a-zA-Z0-9\p{L}\p{N}\s]/u', '', trim(ucwords(str_ireplace('&', '', str_ireplace('&amp;','',$tg))))))); } 
  $tags['tags'] =  implode(', ', $tags['tagsA']); $tags['htags'] = implode(', ', $tags['htagsA']);
  return $tags;
}}            
if (!function_exists('nxs_doFormatMsg')){ function nxs_doFormatMsg($format, $message, $addURLParams=''){ global $nxs_urlLen; $msg = nxs_doSpin($format);// prr($msg); prr($message);// Make "message default"
  if (preg_match('%URL%', $msg)) { $url = $message['url']; if($addURLParams!='') $url .= (strpos($url,'?')!==false?'&':'?').$addURLParams;  $nxs_urlLen = nxs_strLen($url); $msg = str_ireplace("%URL%", $url, $msg);}
  if (preg_match('%SURL%', $msg)) { 
    if (isset($message['surl']) && $message['surl']!='') $url = $message['surl']; else { $url = $message['url']; if($addURLParams!='') $url .= (strpos($url,'?')!==false?'&':'?').$addURLParams; $url = nxs_mkShortURL($url); } 
    $nxs_urlLen = nxs_strLen($url); $msg = str_ireplace("%SURL%", $url, $msg);
  }
  if (preg_match('%IMG%', $msg)) { if (isset($message['imgURL']) && is_array($message['imgURL'])) { $imgURL = trim($message['imgURL']['large']); if ($imgURL=='') $imgURL = trim($message['imgURL']['medium']);   
      if ($imgURL=='') $imgURL = trim($message['imgURL']['original']); if ($imgURL=='') $imgURL = trim($message['imgURL']['thumb']);
    } elseif (!empty($message['imgURL'])) $imgURL = $message['imgURL']; else $imgURL = '';    $msg = str_ireplace("%IMG%", $imgURL, $msg); 
  }
  if (preg_match('%IMGLARGE%', $msg)) $msg = str_ireplace("%IMG%", trim($message['imgURL']['large'], $msg));  
  if (preg_match('%IMGMEDIUM%', $msg)) $msg = str_ireplace("%IMGMEDIUM%", trim($message['imgURL']['medium'], $msg));  
  if (preg_match('%IMGTHUMB%', $msg)) $msg = str_ireplace("%IMGTHUMB%", trim($message['imgURL']['thumb'], $msg));  
  if (preg_match('%IMGORIGINAL%', $msg)) $msg = str_ireplace("%IMGORIGINAL%", trim($message['imgURL']['original'], $msg));  
  
  if (preg_match('%ORID%', $msg)) $msg = str_ireplace("%ORID%", $message['orID'], $msg);  
  if (preg_match('%TITLE%', $msg)) $msg = str_ireplace("%TITLE%", $message['title'], $msg);  
  if (preg_match('%STITLE%', $msg)) { $title = substr($message['title'], 0, 115); $msg = str_ireplace("%STITLE%", $title, $msg); }                    
  if (preg_match('%AUTHORNAME%', $msg)) $msg = str_ireplace("%AUTHORNAME%", $message['authorName'], $msg);
  if (preg_match('%SITENAME%', $msg)) $msg = str_ireplace("%SITENAME%", $message['siteName'], $msg); 
  
  if (preg_match('%ANNOUNCE%', $msg)) { $sText =  trim($message['announce'])!=''?$message['announce']:nsTrnc($message['description'], 300, " ", "...");  $msg = str_ireplace("%ANNOUNCE%", $sText, $msg); }
  if (preg_match('%EXCERPT%', $msg)) { $sText =  trim($message['announce'])!=''?$message['announce']:nsTrnc($message['description'], 300, " ", "...");  $msg = str_ireplace("%EXCERPT%", $sText, $msg); }
  if (preg_match('%RAWEXCERPT%', $msg)) { $sText =  trim($message['announce'])!=''?$message['announce']:nsTrnc($message['description'], 300, " ", "...");  $msg = str_ireplace("%RAWEXCERPT%", $sText, $msg); }
  
  if (preg_match('%TEXT%', $msg)) $msg = str_ireplace("%TEXT%", $message['description'], $msg);     
  if (preg_match('%FULLTEXT%', $msg)) $msg = str_ireplace("%FULLTEXT%", $message['description'], $msg);     
  if (preg_match('%RAWTEXT%', $msg)) $msg = str_ireplace("%RAWTEXT%", $message['description'], $msg);     
      
  
  if (preg_match('%TAGS%', $msg)) { $tags = nxs_doProcessTags($message['tags']);  $msg = str_ireplace("%TAGS%", $tags['tags'], $msg); }
  if (preg_match('%HTAGS%', $msg)) { $tags = nxs_doProcessTags($message['tags']);  $msg = str_ireplace("%HTAGS%", $tags['htags'], $msg); }
  if (preg_match('%CATS%', $msg)) { $tags = nxs_doProcessTags($message['cats']);  $msg = str_ireplace("%CATS%", $tags['cats'], $msg); }
  if (preg_match('%HCATS%', $msg)) { $tags = nxs_doProcessTags($message['hcats']);  $msg = str_ireplace("%HCATS%", $tags['hcats'], $msg); }
    
  if (preg_match('%CF-[a-zA-Z0-9]%', $msg)) { $msgA = explode('%CF', $msg); $mout = '';
    foreach ($msgA as $mms) { 
        if (substr($mms, 0, 1)=='-' && stripos($mms, '%')!==false) { $mGr = CutFromTo($mms, '-', '%'); $cfItem = $message[$mGr]; $mms = str_ireplace("-".$mGr."%", $cfItem, $mms); } $mout .= $mms; 
    } $msg = $mout; 
  }  
  return trim($msg);
}}
//## Common Dialogs
if (!function_exists('nxs_showImgToUseDlg')){ function nxs_showImgToUseDlg($nt, $ii, $imgToUse){ ?>
 <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Image(s) to use:', 'nxs_snap') ?></th>
                  <td><input type="checkbox" class="isAutoImg" <?php if ($imgToUse=='') { ?>checked="checked"<?php } ?>  id="isAutoImg-<?php echo $nt; ?><?php echo $ii; ?>" name="<?php echo $nt; ?>[<?php echo $ii; ?>][isAutoImg]" value="A"/> <?php _e('Auto', 'nxs_snap'); ?>
                  <?php if ($imgToUse!='') { ?> <a onclick="nxs_clPrvImgShow('<?php echo $nt; ?><?php echo $ii; ?>');return false;" href="#"><?php _e('Show all', 'nxs_snap'); ?></a><br/>  
                    <div class="nxs_prevImagesDiv" id="nxs_<?php echo $nt; ?><?php echo $ii; ?>_idivD"><img class="nxs_prevImages" src="<?php echo $imgToUse; ?>"><div style="display:block;" class="nxs_checkIcon"><div class="media-modal-icon"></div></div></div>
                  <?php } else { ?><br/><?php } ?>
                    <div id="imgPrevList-<?php echo $nt; ?><?php echo $ii; ?>" class="nxs_imgPrevList"></div>  
                    <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][imgToUse]" value="<?php echo $imgToUse ?>" id="imgToUse-<?php echo $nt; ?><?php echo $ii; ?>" /> 
                </td></tr> 
<?php }}
if (!function_exists('nxs_showURLToUseDlg')){ function nxs_showURLToUseDlg($nt, $ii, $urlToUse){ ?>
 <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('URL to use:', 'nxs_snap') ?></th>
                  <td><input type="checkbox" class="isAutoURL" <?php if ($urlToUse=='') { ?>checked="checked"<?php } ?>  id="isAutoURL-<?php echo $nt; ?><?php echo $ii; ?>" name="<?php echo $nt; ?>[<?php echo $ii; ?>][isAutoURL]" value="A"/> <?php _e('Auto', 'nxs_snap'); ?> - <i><?php _e('Post URL or globally defined URL will be used', 'nxs_snap'); ?></i>
                  
                    <div class="nxs_prevURLDiv" <?php if (trim($urlToUse)=='') { ?> style="display:none;"<?php } ?> id="isAutoURLFld-<?php echo $nt; ?><?php echo $ii; ?>">
                      &nbsp;&nbsp;&nbsp;<?php _e('URL:', 'nxs_snap') ?> <input size="90" type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][urlToUse]" value="<?php echo $urlToUse ?>" id="URLToUse-<?php echo $nt; ?><?php echo $ii; ?>" /> 
                      <span><?php _e('This will trigger "Network will decide attachment info". Image and other settings will be ignored.', 'nxs_snap') ?></span>
                    </div>
                  
                </td></tr> 
<?php }}

//## Tests
function nxs_cURLTestCode($url){  
  $out = 'There is a problem with cURL. You need to contact your server admin or hosting provider. Here is the PHP code to reproduce the problem:<br/><pre style="color:#005800">&lt;?php '."\r\n".' $ch = curl_init(); '."\r\n".' curl_setopt($ch, CURLOPT_URL, "'.$url.'"); '."\r\n".' curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)"); '."\r\n".' curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); '."\r\n".' curl_setopt($ch, CURLOPT_TIMEOUT, 10); '."\r\n".' curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); '."\r\n".' $response = curl_exec($ch); '."\r\n".' $errmsg = curl_error($ch); '."\r\n".' $cInfo = curl_getinfo($ch); '."\r\n".' curl_close($ch); '."\r\n".' print_r($errmsg); '."\r\n".' print_r($cInfo); '."\r\n".' print_r($response); '."\r\n".'?&gt;</pre>'; return $out; 
}
function nxs_cURLTest($url, $msg, $testText){ echo "<br/>--== Test Requested ... ".$url."<br/>";  $ch = curl_init(); curl_setopt($ch, CURLOPT_URL, $url); 
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)"); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_TIMEOUT, 10); curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  $response = curl_exec($ch); $errmsg = curl_error($ch); $cInfo = curl_getinfo($ch); curl_close($ch); echo "Testing ... ".$url." - ".$cInfo['url']."<br/>";
  if (stripos($response, $testText)!==false) echo "....".$msg." - OK<br/>"; else { echo "....<b style='color:red;'>".$msg." - Problem</b><br/>"; prr($response); prr($errmsg); prr($cInfo); echo nxs_cURLTestCode($url);  }
}

//## Reposter
function nxs_adjRpst($optionsii, $pval){  if (empty($optionsii['rpstDays'])) $optionsii['rpstDays'] = 0; if (empty($optionsii['rpstHrs'])) $optionsii['rpstHrs'] = 0; if (empty($optionsii['rpstMins'])) $optionsii['rpstMins'] = 0;
    
    $rpstEvrySecEx = $optionsii['rpstDays']*86400+$optionsii['rpstHrs']*3600+$optionsii['rpstMins']*60; $isRpstWasOn = isset($optionsii['rpstOn']) && $optionsii['rpstOn']=='1';
    
    if (isset($pval['rpstOn']))    $optionsii['rpstOn'] = $pval['rpstOn']; else $optionsii['rpstOn'] = 0;
    
    if (isset($pval['rpstDays']))  $optionsii['rpstDays'] = trim($pval['rpstDays']);       
    if (isset($pval['rpstHrs']))   $optionsii['rpstHrs'] = trim($pval['rpstHrs']);     if ((int)$optionsii['rpstHrs']>23) $optionsii['rpstHrs'] = 23;
    if (isset($pval['rpstMins']))  $optionsii['rpstMins'] = trim($pval['rpstMins']);   if ((int)$optionsii['rpstMins']>59) $optionsii['rpstMins'] = 59;    
    if (isset($pval['rpstRndMins']))  $optionsii['rpstRndMins'] = trim($pval['rpstRndMins']);       
    if (isset($pval['rpstPostIncl']))  $optionsii['rpstPostIncl'] = trim($pval['rpstPostIncl']);     
    
    if (isset($pval['rpstStop']))  $optionsii['rpstStop'] = trim($pval['rpstStop']); else $optionsii['rpstStop'] = 'O';      
     
    
    $rpstEvrySecNew = $optionsii['rpstDays']*86400+$optionsii['rpstHrs']*3600+$optionsii['rpstMins']*60;
    $rpstRNDSecs = isset($optionsii['rpstRndMins'])?$optionsii['rpstRndMins']*60:0; if ($rpstRNDSecs>$rpstEvrySecNew) $optionsii['rpstRndMins'] = 0;
    
    if ($rpstEvrySecNew!=$rpstEvrySecEx || (!$isRpstWasOn && $optionsii['rpstOn']=='1')) { $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ); $optionsii['rpstNxTime'] = $currTime + $rpstEvrySecNew; }
    if (isset($pval['rpstType']))  $optionsii['rpstType'] = trim($pval['rpstType']);       
    if (isset($pval['rpstTimeType']))  $optionsii['rpstTimeType'] = trim($pval['rpstTimeType']);       
    if (isset($pval['rpstFromTime']))  $optionsii['rpstFromTime'] = trim($pval['rpstFromTime']);       
    if (isset($pval['rpstToTime']))  $optionsii['rpstToTime'] = trim($pval['rpstToTime']);       
    if (isset($pval['rpstOLDays']))  $optionsii['rpstOLDays'] = trim($pval['rpstOLDays']);       
    if (isset($pval['rpstNWDays']))  $optionsii['rpstNWDays'] = trim($pval['rpstNWDays']);       
    if (isset($pval['rpstOnlyPUP']))  $optionsii['rpstOnlyPUP'] = trim($pval['rpstOnlyPUP']); else $optionsii['rpstOnlyPUP'] = 0;     
    
    if (isset($pval['nxsCPTSeld']))      $optionsii['nxsCPTSeld'] = serialize($pval['nxsCPTSeld']);              
    
    if (isset($pval['fltrsOn'])) $optionsii['fltrsOn'] = trim($pval['fltrsOn']); else $optionsii['fltrsOn'] = 0;     
    
    if (isset($pval['tagsSel'])) {  $optionsii['tagsSel'] = trim($pval['tagsSel']); $tagsSelX = array(); $tggsSel = explode(',', $optionsii['tagsSel']); 
      foreach ($tggsSel as $tggg){ $tggg = trim($tggg); $tagsSelX[] = $tggg;  
        if (stripos($tggg, '|')!==false) { $tgArr =  explode('|', $tggg); $taxonomy = $tgArr[0]; $tgggT = $tgArr[1]; } else { $taxonomy = 'post_tag'; $tgggT = $tggg; } 
        $tgArr = get_term_by( 'slug', $tgggT, $taxonomy, ARRAY_A); if (is_array($tgArr)) $tagsSelX[] = $tgArr['term_id'];
      }  $optionsii['tagsSelX'] = implode(',', $tagsSelX); 
    }
    if (isset($pval['custTaxSel']))  $optionsii['custTaxSel'] = trim($pval['custTaxSel']);     
        
    if (isset($pval['rpstBtwHrsType']))  $optionsii['rpstBtwHrsType'] = trim($pval['rpstBtwHrsType']);       
    if (isset($pval['rpstBtwHrsT']))  $optionsii['rpstBtwHrsT'] = trim($pval['rpstBtwHrsT']);  if (isset($optionsii['rpstBtwHrsT'])&&(int)$optionsii['rpstBtwHrsT']>23) $optionsii['rpstBtwHrsT'] = 23;         
    if (isset($pval['rpstBtwHrsF']))  $optionsii['rpstBtwHrsF'] = trim($pval['rpstBtwHrsF']);  if (isset($optionsii['rpstBtwHrsF'])&&(int)$optionsii['rpstBtwHrsF']>23) $optionsii['rpstBtwHrsF'] = 23;               
    if (isset($pval['rpstBtwDays']))  $optionsii['rpstBtwDays'] = $pval['rpstBtwDays']; else $optionsii['rpstBtwDays'] = array(); 
    return $optionsii;
}

function nxs_showCatTagsCTFilters($nt, $ii, $options){ global $nxs_snapAvNts, $nxs_plurl; 
  if (!isset($options['tagsSel'])) $options['tagsSel'] = ''; if (!isset($options['custTaxSel'])) $options['custTaxSel'] = '';
  ?> <div class="nxs_tls_cpt">
  
  <?php _e('Filter Autoposting by', 'nxs_snap'); ?></div>
    <div class="nxs_tls_bd">
    <div style="width:100%;"><strong><?php _e('Categories', 'nxs_snap'); ?>:</strong>
       <input value="0" id="catSelA<?php echo strtoupper($nt); ?><?php echo $ii; ?>" type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][catSel]" <?php if ((int)$options['catSel'] != 1) echo "checked"; ?> /> <?php _e('All', 'nxs_snap'); ?>
       <input value="1" id="catSelS<?php echo strtoupper($nt); ?><?php echo $ii; ?>" type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][catSel]" <?php if ((int)$options['catSel'] == 1) echo "checked"; ?> /> <a href="#" style="text-decoration: none;" class="showCats" id="nxs_SCA_<?php echo strtoupper($nt); ?><?php echo $ii; ?>" onclick="jQuery('#catSelS<?php echo strtoupper($nt); ?><?php echo $ii; ?>').attr('checked', true); jQuery('#tmpCatSelNT').val('<?php echo strtoupper($nt); ?><?php echo $ii; ?>'); nxs_markCats( jQuery('#nxs_SC_<?php echo strtoupper($nt); ?><?php echo $ii; ?>').val() ); jQuery('#showCatSel').bPopup({ modalClose: false, appendTo: '#nsStForm', opacity: 0.6, follow: [false, false], position: [75, 'auto']}); return false;"><?php _e('Selected', 'nxs_snap'); ?><?php if ($options['catSelEd']!='') echo "[".(substr_count($options['catSelEd'], ",")+1)."]"; ?></a>       
       <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][catSelEd]" id="nxs_SC_<?php echo strtoupper($nt); ?><?php echo $ii; ?>" value="<?php echo $options['catSelEd']; ?>" />
    <br/><i><?php _e('Only selected categories will be autoposted to this account', 'nxs_snap'); ?></i></div> 
    <br/>
    <div style="width:100%;"><strong><?php _e('Tags and Custom Taxonomies', 'nxs_snap'); ?>:</strong>
       <input name="<?php echo $nt; ?>[<?php echo $ii; ?>][tagsSel]" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['tagsSel'], ENT_COMPAT, "UTF-8")), 'nxs_snap') ?>" />     
    <br/><i><?php _e('Only posts with those tags assigned will be autoposted to this account, you can include custom taxonomy tags in taxonomy_slug|tag format.', 'nxs_snap'); ?></i></div> 
    <br/>
    </div> <?php
}


function nxs_showRepostSettings($nt, $ii, $options){ global $nxs_snapAvNts, $nxs_plurl;   
  if (empty($options['rpstPostIncl'])) $options['rpstPostIncl'] = 0; if (empty($options['rpstPostIncl'])) $options['rpstLastShTime'] = ''; if (empty($options['rpstNxTime'])) $options['rpstNxTime'] = '';
  if (empty($options['rpstLastPostID'])) $options['rpstLastPostID'] = '';

  ?>
    <div class="nxs_tls_cpt">
   <?php _e('Auto Reposting', 'nxs_snap'); ?>&nbsp;&nbsp;<span class="nxsInstrSpan"><a href="http://www.nextscripts.com/snap-features/old-posts-auto-reposting/" target="_blank"><?php _e('[Instructions]', 'nxs_snap'); ?></a> &nbsp;&nbsp; <b style="color: darkred;">Please note:</b> This feature is depreciated, <a href="http://www.nextscripts.com/blog/old-posts-reposting-no-longer-supported/" target="_blank">no longer supported</a> and will be replaced with something much better in the upcoming ver 3.5 </span>
   </div>
   
   <?php $cr = get_option('NXS_cronCheck'); if (!empty($cr) && is_array($cr) && isset($cr['status']) && $cr['status']=='0') { 
      global $plgn_NS_SNAutoPoster; if (!isset($plgn_NS_SNAutoPoster)) return; $gOptions = $plgn_NS_SNAutoPoster->nxs_options; 
       if (isset($gOptions['forceBrokenCron']) && $gOptions['forceBrokenCron'] =='1') { ?> 
         <span style="color: red"> <?php _e('Your WP Cron is not working correctly. Auto Reposting service is active by force. <br/> This might cause problems. Please see the test results and recommendations', 'nxs_snap'); ?>
         &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span>
        <?php } else { ?> <span style="color: red"> <?php _e('Auto Reposting service is Disabled. Your WP Cron is not working correctly. Please see the test results and recommendations', 'nxs_snap'); ?>
     &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span>
   <?php return; } } ?>
   
   
   <div class="nxs_tls_bd">
     <div class="nxs_tls_sbInfo"><?php _e('Plugin could autorepost existing posts', 'nxs_snap'); ?></div>
     <input value="1"  id="riC<?php echo $ii; ?>" <?php if (isset($options['rpstOn']) && trim($options['rpstOn'])=='1') echo "checked"; ?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstOn]"/> 
       <b><?php _e('Repost existing posts every', 'nxs_snap'); ?> </b>
     
     <input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstDays]" style="width: 35px;" value="<?php echo isset($options['rpstDays'])?$options['rpstDays']:'0'; ?>" />&nbsp;<?php _e('Days', 'nxs_snap'); ?>&nbsp;&nbsp;
     <input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstHrs]" style="width: 35px;" value="<?php echo isset($options['rpstHrs'])?$options['rpstHrs']:'2'; ?>" />&nbsp;<?php _e('Hours', 'nxs_snap'); ?>&nbsp;&nbsp;
     <input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstMins]" style="width: 35px;" value="<?php echo isset($options['rpstMins'])?$options['rpstMins']:'0'; ?>" />&nbsp;<?php _e('Minutes', 'nxs_snap'); ?>     
     <div style="padding-left:10px;padding-top:10px;line-height:30px;"> 
     
     <b><?php _e('Randomize posting time &#177;', 'nxs_snap'); ?> </b>
     <input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstRndMins]" style="width: 35px;" value="<?php echo isset($options['rpstRndMins'])?$options['rpstRndMins']:'15'; ?>" onmouseout="hidePopShAtt('RPST1');" onmouseover="showPopShAtt('RPST1', event);" />&nbsp;<?php _e('Minutes', 'nxs_snap'); ?>
     <br/>     
     <input value="1"  id="riOC<?php echo $ii; ?>" <?php if (isset($options['rpstOnlyPUP']) && trim($options['rpstOnlyPUP'])=='1') echo "checked"; ?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstOnlyPUP]"/> 
       <b><?php _e('Repost ONLY previously unautoposted posts', 'nxs_snap'); ?></b>
     <br/>
     <?php $args=array('public'=>true, '_builtin'=>false);  $output = 'names';  $operator = 'and';  $post_types = array(); 
     if (function_exists('get_post_types')) $post_types=get_post_types($args, $output, $operator); 
       if (!empty($post_types) && is_array($post_types)) { ?>
     <b><?php _e('Repost: (Choose Posts, Pages, Custom Post Types)', 'nxs_snap'); ?></b>
     <?php $post_typesIncl = array('post'=>'post', 'page'=>'page'); $post_types = array_merge($post_typesIncl, $post_types);    if ($options['nxsCPTSeld']=='a:1:{i:0;s:1:"0";}') $options['nxsCPTSeld'] = '';
       if (!empty($options['nxsCPTSeld'])) $nxsCPTSeld = unserialize($options['nxsCPTSeld']); else $nxsCPTSeld = array('post');  
             ?> <div class="nxs_box_inside" style="padding: 0px;" > <div class="itemDiv"  style="padding: 0px;"> <div class="taxonomydiv"><div class="tabs-panel" style="padding: 10px;"><input type="hidden" name="nxsCPTSeld[]" value="0" /> <?php //prr($nxsCPTSeld); prr($post_types); prr($_POST['nxsCPTSeld']);              
             foreach ($post_types as $cptID=>$cptName){ if (in_array($cptID, $nxsCPTSeld)) $dCh = ' checked="checked" '; else $dCh = "";
              ?><input type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][nxsCPTSeld][]" value="<?php echo esc_attr($cptID); ?>"<?php echo $dCh ?>>&nbsp;<?php echo $cptName ?><br/> <?php
             }
      ?></div></div> </div> </div>          
     <?php } ?>
     <?php if (function_exists('nxs_doSMAS41')) nxs_doSMAS41($nt, $ii, $options); ?>          
     <b><?php _e('Get posts', 'nxs_snap'); ?></b>
       <select id="riS<?php echo $nt; ?><?php echo $ii; ?>" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstType]" onchange="nxs_actDeActTurnOff(jQuery(this).attr('id'));"><?php if (function_exists('nxs_doSMAS42')) nxs_doSMAS42($options); ?>        
        <option value="2" <?php  if (isset($options['rpstType']) && $options['rpstType']=='2') echo 'selected="selected"' ?>>One By One - Old to New</option><option value="3" <?php if (isset($options['rpstType']) && $options['rpstType']=='3') echo 'selected="selected"' ?>>One By One - New to Old</option>
        </select> 
      <br/> 
      <div style="padding-left: 15px;">
      <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstTimeType]" value="D" <?php if (isset($options['rpstTimeType']) && $options['rpstTimeType']=='D') echo 'checked="checked"'; ?> />
      
      <?php _e('from', 'nxs_snap'); ?>&nbsp;<input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstFromTime]" style="width: 75px;" value="<?php echo isset($options['rpstFromTime'])?$options['rpstFromTime']:''; ?>" />&nbsp;          
      <?php _e('to', 'nxs_snap'); ?>&nbsp;<input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstToTime]" style="width: 75px;" value="<?php echo isset($options['rpstToTime'])?$options['rpstToTime']:''; ?>" />
     <br/>
     <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstTimeType]" value="A" <?php if (!isset($options['rpstTimeType']) || $options['rpstTimeType']=='A') echo 'checked="checked"'; ?> />
     <?php _e('Older then', 'nxs_snap'); ?>&nbsp;<input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstOLDays]" style="width: 35px;" value="<?php  echo isset($options['rpstOLDays'])?$options['rpstOLDays']:'30'; ?>" />&nbsp;<?php _e('Days', 'nxs_snap'); ?>          
     <?php _e('and Newer then', 'nxs_snap'); ?>&nbsp;<input type="text" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstNWDays]" style="width: 35px;" value="<?php  echo isset($options['rpstNWDays'])?$options['rpstNWDays']:'365'; ?>" />&nbsp;<?php _e('Days', 'nxs_snap'); ?>     
     </div>
     <div id="riS<?php echo $nt; ?><?php echo $ii; ?>xd"  style="padding-left: 0px;<? if (isset($options['rpstType']) && $options['rpstType']=='1') echo "display:none;"; ?>"><b><?php _e('When finished', 'nxs_snap'); ?>:</b>       
         <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstStop]" value="O" <?php if (empty($options['rpstStop']) || (isset($options['rpstStop']) && trim($options['rpstStop'])=='O')) echo "checked"; ?>  /> <?php _e('Auto Turn Reposting Off', 'nxs_snap') ?>
         &nbsp;&nbsp;&nbsp;
         <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstStop]" value="W" <?php if (isset($options['rpstStop']) && trim($options['rpstStop'])=='W') echo 'checked="cheXcked"'; ?> /> <?php _e('Wait for new posts', 'nxs_snap') ?>
         &nbsp;&nbsp;&nbsp;
         <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstStop]" value="R" <?php if (isset($options['rpstStop']) && trim($options['rpstStop'])=='R') echo 'checked="cheTcked"'; ?> /> <?php _e('Loop it. Reset and Start from the begining', 'nxs_snap'); ?>
         </div>
    
     <hr/>
     <strong style="font-size: 12px; margin: 10px; margin-left: 1px;">New posts will be set by default to:</strong>
             <select name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"><option <?php echo !empty($options['rpstPostIncl'])?'selected="selected"':''; ?> value="nxsi<?php echo $ii.$nt; ?>">Enabled for Repost</option>
             <option <?php echo empty($options['rpstPostIncl'])?'selected="selected"':''; ?>  value="0">Disabled for Repost</option></select><br/>
      <div style="padding-left: 15px;"> <img id="nxsLoadingImg<?php echo $nt; ?><?php echo $ii; ?>" style="display: none;" src='<?php echo $nxs_plurl; ?>img/ajax-loader-sm.gif' />       
      
      <?php      
        global $nxs_rpst_older, $nxs_rpst_newer, $nxs_rpst_lastID, $nxs_rpst_lastTime, $nxs_rpst_type, $nxs_rpst_code, $nxs_rpst_NT;  $ntOpts = $options;         
        $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
        if (!empty($ntOpts['nxsCPTSeld'])) $tpArray = maybe_unserialize($ntOpts['nxsCPTSeld']); else $tpArray = 'post';
        if ($ntOpts['rpstType']=='1') $args = array ( 'orderby' => 'rand', 'posts_per_page' => '1', 'post_type' => $tpArray, 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'suppress_filters' => false ); 
        if ($ntOpts['rpstType']=='2') $args = array ( 'posts_per_page' => '1', 'orderby' => 'date ID', 'order'=>'ASC', 'post_type' => $tpArray, 'post_status' => 'publish', 'suppress_filters' => false );
        if ($ntOpts['rpstType']=='3') $args = array ( 'posts_per_page' => '1', 'orderby' => 'date ID', 'order'=>'DESC', 'post_type' => $tpArray, 'post_status' => 'publish', 'suppress_filters' => false );                   
        $rpstToTime = strtotime($ntOpts['rpstToTime']); if ($currTime < $rpstToTime) $rpstToTime = $currTime;
        $rpstFromTime = strtotime($ntOpts['rpstFromTime']); if ($currTime < $rpstFromTime) $rpstFromTime = $currTime;
        if ($ntOpts['rpstTimeType']=='D') { $nxs_rpst_older = ceil(abs($currTime - $rpstToTime) / 86400); $nxs_rpst_newer = ceil(abs($currTime - $rpstFromTime) / 86400);                   
          } else { $nxs_rpst_older = $ntOpts['rpstOLDays']; $nxs_rpst_newer = $ntOpts['rpstNWDays']; } $ggg = $ntOpts['rpstType']=='1'?'Random':($ntOpts['rpstType']=='3'?'New to Old':'Old to New');
        if ($nxs_rpst_newer>5000) $nxs_rpst_newer = 5000;  if ($nxs_rpst_newer<$nxs_rpst_older) $nxs_rpst_older = 0;                 
        $nxs_rpst_code = 'nxsi'.$ii.$nt; $nxs_rpst_NT = strtoupper($nt);
        add_filter( 'posts_join' , 'nxs_custom_posts_join');
        if (isset($ntOpts['rpstOnlyPUP']) && trim($ntOpts['rpstOnlyPUP'])=='1')  {  add_filter( 'posts_where', 'nxs_filter_where_only' ); }
        add_filter( 'posts_where', 'nxs_filter_where' ); $query = new WP_Query( $args ); remove_filter( 'posts_where', 'filter_where' ); 
        echo "Total posts included in reposting: ".$query->found_posts;      
      ?><br/>
      
     <?php _e('Set All Existing Posts to: ', 'nxs_snap'); ?>
     &nbsp;&nbsp;<span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','1','<?php echo $ii; ?>'); return false;"><?php _e('[Enabled for Repost]', 'nxs_snap'); ?></a> </span>
     &nbsp;&nbsp;<span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','0','<?php echo $ii; ?>'); return false;"><?php _e('[Disabled for Repost]', 'nxs_snap'); ?></a> </span>        
     &nbsp;&nbsp;<span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','2','<?php echo $ii; ?>'); return false;"><?php _e('[Enabled/Disabled for Repost according to Categories/Tags/Taxonomies filters]', 'nxs_snap'); ?></a> </span>        
              
     </div><hr/>
     <b><?php _e('Last post', 'nxs_snap'); ?></b>&nbsp;(ID:&nbsp;<?php echo !empty($options['rpstLastPostID'])?$options['rpstLastPostID']:''; ?>)&nbsp;<b><?php _e('was re-posted on:', 'nxs_snap'); ?></b>&nbsp;<?php echo $options['rpstLastShTime']>0?date_i18n('Y-m-d H:i', $options['rpstLastShTime']):'Never'; ?>
        &nbsp;&nbsp;<b><?php _e('Next post will be ~', 'nxs_snap'); ?></b>&nbsp;<?php echo $options['rpstNxTime']>0?date_i18n('Y-m-d H:i', $options['rpstNxTime']):'Never'; ?> &lt;==
        &nbsp;&nbsp;<span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','X','<?php echo $ii; ?>'); return false;"><?php _e('[Reset]', 'nxs_snap'); ?></a> </span>
     <br/>
     <b><?php _e('Set "Last re-posted post ID" to:', 'nxs_snap'); ?>&nbsp;<input type="text" id="<?php echo $nt; ?><?php echo $ii; ?>SetLPID" style="width: 65px;" value="<?php echo $options['rpstLastPostID']; ?>" />
     &nbsp;&nbsp;<span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','L','<?php echo $ii; ?>'); return false;"><?php _e('[Set]', 'nxs_snap'); ?></a> </span></b>
     </div>      
   </div>      
    <?php 
}
function nxs_custom_posts_join($join){ global $wpdb; $join .= " LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id "; return $join;}
function nxs_filter_where_only( $where = '' ) { global $wpdb; $where .= " AND ($wpdb->postmeta.meta_key = 'snap_isAutoPosted' AND $wpdb->postmeta.meta_value = '1') "; return $where; }
function nxs_filter_where( $where = '' ) { global $wpdb, $nxs_rpst_older, $nxs_rpst_newer, $nxs_rpst_lastID, $nxs_rpst_lastTime, $nxs_rpst_type, $nxs_rpst_typeONLY, $nxs_rpst_code, $nxs_rpst_NT; 
    $where .= " AND post_date > '" . date_i18n('Y-m-d', strtotime('-'.$nxs_rpst_newer.' days')) . " 00:00:00'" . " AND post_date < '" . date_i18n('Y-m-d', strtotime('-'.$nxs_rpst_older.' days')) . " 23:59:59'";    
    $where .= " AND ($wpdb->postmeta.meta_key = 'snap".$nxs_rpst_NT."' AND $wpdb->postmeta.meta_value LIKE '%".$nxs_rpst_code."%') ";
    if ($nxs_rpst_type=='2' && $nxs_rpst_lastID!='') $where .= " AND ( (post_date = '".$nxs_rpst_lastTime."' && ID > ".$nxs_rpst_lastID." ) || post_date > '".$nxs_rpst_lastTime."' )";
    if ($nxs_rpst_type=='3' && $nxs_rpst_lastID!='') $where .= " AND ( (post_date = '".$nxs_rpst_lastTime."' && ID < ".$nxs_rpst_lastID." ) || post_date < '".$nxs_rpst_lastTime."' )";
    if ($nxs_rpst_typeONLY) $where .= " AND ($wpdb->postmeta.meta_key = 'snap_isAutoPosted' AND $wpdb->postmeta.meta_value = '1') ";
    return $where; 
}

function nxs_rePoster(){ global $nxs_snapAvNts,$plgn_NS_SNAutoPoster, $nxs_rpst_older, $nxs_rpst_newer, $nxs_rpst_lastID, $nxs_rpst_lastTime, $nxs_rpst_type, $nxs_rpst_code, $nxs_rpst_NT;   
  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options;  $rpstBtwHrsF = 0; $rpstBtwHrsT = 0;
  $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );  $hasChanged = false;   
  // if (stripos($_SERVER["REQUEST_URI"], 'wp-cron.php')!==false) nxs_addToLogN('A', 'NXSPoster - Cron', $logNT, '-=Time=- '.$ret. "ERR: ".$currTime, $extInfo);
  if (stripos($_SERVER["REQUEST_URI"], 'wp-cron.php')===false) return false; $warn = true;
  
  foreach ($nxs_snapAvNts as $avNt) {
    if (isset($options[$avNt['lcode']]) && is_array($options[$avNt['lcode']]) && count($options[$avNt['lcode']])>0) { 
        foreach ($options[$avNt['lcode']] as $ii=>$ntOpts) { $logNT = '<span style="color:#800000">'.$avNt['name'].'</span> - '.(isset($ntOpts['nName'])?$ntOpts['nName']:'');      
          if (isset($ntOpts['rpstOn']) && $ntOpts['rpstOn']=='1') {    
            //## Calculate Times
            $lastTime = (isset($ntOpts['rpstLastShTime']) && (int)$ntOpts['rpstLastShTime']>0 )?$ntOpts['rpstLastShTime']:$currTime;
            $rpstEvrySec = $ntOpts['rpstDays']*86400+$ntOpts['rpstHrs']*3600+$ntOpts['rpstMins']*60; $rndSec = $ntOpts['rpstRndMins']*60;
            $nxTime = (isset($ntOpts['rpstNxTime']) && (int)$ntOpts['rpstNxTime']>0)?$ntOpts['rpstNxTime']:$currTime+$rpstEvrySec;  
            //## First time? Set the options and get out. 
            if (empty($ntOpts['rpstLastShTime'])) {  $ntOpts['rpstLastShTime'] = $currTime; $ntOpts['rpstNxTime'] = $lastTime + $rpstEvrySec + rand(0-$rndSec, $rndSec); 
              $options[$avNt['lcode']][$ii] = $ntOpts; update_option($plgn_NS_SNAutoPoster->dbOptionsName, $options); $plgn_NS_SNAutoPoster->nxs_options = $options;  
               nxs_addToLogN('S', 'RE-Poster', $logNT, 'Initialization - First post will be: '.date_i18n('Y-m-d H:i:s', $ntOpts['rpstNxTime']), $extInfo); continue; 
            }
            //## Is it time to post?
            if ($nxTime < $currTime) {  $times =  "Requested Time: ".date_i18n('Y-m-d H:i:s', $nxTime)." | Current Time:".date_i18n('Y-m-d H:i:s', $currTime)." | "; 
              //## Check if WP Cron is healthy   
              if ($warn) { $cr = get_option('NXS_cronCheck'); $warn = false; if (!empty($cr) && is_array($cr) && isset($cr['status']) && $cr['status']=='0') { global $nxs_snapThisPageUrl;     
                if (isset($options['forceBrokenCron']) && $options['forceBrokenCron'] =='1') 
                  nxs_addToLogN('W', 'Re-Poster is active by force. This could cause problems.', $logNT, 'Please see ', '<a target="_blank" href="'.$nxs_snapThisPageUrl.'&do=crtest">WP Cron Test Results</a>|'.$times); 
                else { nxs_addToLogN('W', 'Re-Poster is Disabled', $logNT, 'Please see ', '<a target="_blank" href="'.$nxs_snapThisPageUrl.'&do=crtest">WP Cron Test Results</a>|'.$times); return; }
              }} 
              
              if (!isset($ntOpts['rpstNxTime']) || (int)$ntOpts['rpstNxTime']<1) $ntOpts['rpstNxTime'] = 0; //prr($ntOpts);            
              //## Check if Day or Hour is excluded
              if (isset($ntOpts['rpstBtwHrsType']) && $ntOpts['rpstBtwHrsType']=='D'){ 
                //## Check Days
                if (isset($ntOpts['rpstBtwDays']) && count($ntOpts['rpstBtwDays'])>0 ) $rpstBtwDays = $ntOpts['rpstBtwDays']; else $rpstBtwDays = array();            
                if (is_array($rpstBtwDays) && count($rpstBtwDays)>0) { $currDay = (int)date_i18n('w'); if (!(in_array($currDay, $rpstBtwDays))) { // echo "D :( ";
                  nxs_addToLogN('S', 'RE-Poster', $logNT, 'Skipped - Excluded Day - '.$currDay, $extInfo);  continue;  
                }}
                //## Check Hours
                if (isset($ntOpts['rpstBtwHrsF']) && (int)$ntOpts['rpstBtwHrsF']>0) $rpstBtwHrsF = (int)$ntOpts['rpstBtwHrsF']; else $rpstBtwHrsF = 0;
                if (isset($ntOpts['rpstBtwHrsT']) && (int)$ntOpts['rpstBtwHrsT']>0) $rpstBtwHrsT = (int)$ntOpts['rpstBtwHrsT'];
                if ($rpstBtwHrsT>0) { $currHour = (int)date_i18n('H', $currTime);  //echo "H ".$currHour." ?";
                if ( !( ($rpstBtwHrsF<$rpstBtwHrsT && $currHour<$rpstBtwHrsT && $currHour>=$rpstBtwHrsF) || ($rpstBtwHrsF>$rpstBtwHrsT && $currHour<$rpstBtwHrsF && $currHour>=$rpstBtwHrsT) )) {  //echo "H :( ";
                  nxs_addToLogN('S', 'RE-Poster', $logNT, 'Skipped - Excluded Hour - '.$currHour, $extInfo);  continue;  
                }}
              }
              //## Do Post                
              $hasChanged = true; $nxs_rpst_type = $ntOpts['rpstType'];
              $nxs_rpst_lastID = (isset($ntOpts['rpstLastPostID']) && (int)$ntOpts['rpstLastPostID']>0)?$ntOpts['rpstLastPostID']:($ntOpts['rpstType']=='3'?'90000000':'0');
              $nxs_rpst_lastTime = (!empty($ntOpts['rpstLastPostTime']) && $ntOpts['rpstLastPostTime']!='2050-12-12' && $ntOpts['rpstLastPostTime']!='1975-01-01')?$ntOpts['rpstLastPostTime']:($ntOpts['rpstType']=='3'?'2050-12-12':'1975-01-01');
              if (!empty($ntOpts['nxsCPTSeld'])) $tpArray = maybe_unserialize($ntOpts['nxsCPTSeld']); else $tpArray = 'post';
              //nxs_addToLogN('S', 'pTypes', $logNT, print_r($tpArray, true), $extInfo); // $tpArray = array('post', 'location');
              if ($ntOpts['rpstType']=='1') $args = array ( 'orderby' => 'rand', 'posts_per_page' => '1', 'post_type' => $tpArray, 'ignore_sticky_posts' => 1, 'post_status' => 'publish', 'suppress_filters' => false ); 
              if ($ntOpts['rpstType']=='2') $args = array ( 'posts_per_page' => '1', 'orderby' => 'date ID', 'order'=>'ASC', 'post_type' => $tpArray, 'post_status' => 'publish', 'suppress_filters' => false );
              if ($ntOpts['rpstType']=='3') $args = array ( 'posts_per_page' => '1', 'orderby' => 'date ID', 'order'=>'DESC', 'post_type' => $tpArray, 'post_status' => 'publish', 'suppress_filters' => false );                   
              //## Get Post for Reposting
              //   nxs_addToLogN('S', 'pTypes- ARG', $logNT, print_r($args, true), $extInfo);
              $rpstToTime = strtotime($ntOpts['rpstToTime']); if ($currTime < $rpstToTime) $rpstToTime = $currTime;  $rpstFromTime = strtotime($ntOpts['rpstFromTime']); if ($currTime < $rpstFromTime) $rpstFromTime = $currTime;
              if ($ntOpts['rpstTimeType']=='D') { $nxs_rpst_older = ceil(abs($currTime - $rpstToTime) / 86400); 
                $nxs_rpst_newer = ceil(abs($currTime - $rpstFromTime) / 86400);                   
              } else { $nxs_rpst_older = $ntOpts['rpstOLDays']; $nxs_rpst_newer = $ntOpts['rpstNWDays']; } $ggg = $ntOpts['rpstType']=='1'?'Random':($ntOpts['rpstType']=='3'?'New to Old':'Old to New');
              if ($nxs_rpst_newer>5000) $nxs_rpst_newer = 5000;  if ($nxs_rpst_newer<$nxs_rpst_older) $nxs_rpst_older = 0;
                $nxs_rpst_code = 'nxsi'.$ii.$avNt['lcode']; $nxs_rpst_NT = strtoupper($avNt['lcode']);
                add_filter( 'posts_join' , 'nxs_custom_posts_join');
                if (isset($ntOpts['rpstOnlyPUP']) && trim($ntOpts['rpstOnlyPUP'])=='1')  {  add_filter( 'posts_where', 'nxs_filter_where_only' ); }
                add_filter( 'posts_where', 'nxs_filter_where' ); $query = new WP_Query( $args ); remove_filter( 'posts_where', 'filter_where' ); // $extInfo = print_r($query, true);                   
                   
                $rpstLastPostID = $query->posts[0]->ID;  $rpstLastPostTime = $query->posts[0]->post_date;  $ntOpts['rpstLastPostTime'] =  ($rpstLastPostTime!='')?$rpstLastPostTime:($ntOpts['rpstType']=='3'?'1985-01-01':'2050-12-12');
                $extInfo = " | Reposting (<b>".$ggg."</b>) POST ID:".$rpstLastPostID. " | Total posts included in reposting: ".$query->found_posts." | Prev Post ID:".$nxs_rpst_lastID ." | ".($options['extDebug']=='1'?"|Query: ".print_r($query->request, true):'');
                   
                //echo "<br/>\r\n".$rpstEvrySec."<br/>\r\n";
                $ntOpts['rpstLastShTime'] = $currTime; $rndTime = rand(0-$rndSec, $rndSec); $ntOpts['rpstNxTime'] = $lastTime + $rpstEvrySec*2 + $rndTime;  
                if ((int)$rpstLastPostID<1) {  
                  $extInfo = " | Reposting (<b>".$ggg."</b>) | Total posts included in reposting: ".$query->found_posts." | ".($options['extDebug']=='1'?"|Query: ".print_r($query->request, true):'');                      
                  if ($ntOpts['rpstType']=='1') nxs_addToLogN('S','Random Re-Posting - Nothing to post',$logNT, $times.'| Last Time:'.date_i18n('Y-m-d H:i:s', $lastTime).' RND Time: '.$rndTime.' - Next Time - '.date_i18n('Y-m-d H:i:s', $ntOpts['rpstNxTime']).")", $extInfo);
                  else { if (!isset($ntOpts['rpstStop']) || (isset($ntOpts['rpstStop']) && trim($ntOpts['rpstStop'])=='O')) { $ntOpts['rpstOn']='0';  
                      nxs_addToLogN('S','RE-Posting',$logNT,'End of Query - Turning Auto-Reposting Off - '.$times.' | Last Time:'.date_i18n('Y-m-d H:i:s', $lastTime).' Next Time - '.date_i18n('Y-m-d H:i:s', $ntOpts['rpstNxTime']).")", $extInfo);
                    } elseif ( trim($ntOpts['rpstStop'])=='W') 
                      nxs_addToLogN('S','RE-Posting',$logNT,'(Waiting mode is ON) <b>Nothing to Repost.</b> | '.$times.' | Last Time:'.date_i18n('Y-m-d H:i:s', $lastTime).' Next Time - '.date_i18n('Y-m-d H:i:s', $ntOpts['rpstNxTime']).")", $extInfo);
                    elseif ( trim($ntOpts['rpstStop'])=='R') { $ntOpts['rpstLastPostID'] = ($ntOpts['rpstType']=='3'?'90000000':'0');
                      nxs_addToLogN('S','RE-Posting',$logNT,'(<b>Nothing to Repost.</b> - End of Query - <b>Resetting<b>)  | '.$times.' | Last Time:'.date_i18n('Y-m-d H:i:s', $lastTime).' Next Time - '.date_i18n('Y-m-d H:i:s', $ntOpts['rpstNxTime']).")", $extInfo);                    }
                  }
                } else { $ntOpts['rpstLastPostID'] = $rpstLastPostID;                                      
                  //## Actual Post                     
                  $clName = 'nxs_snapClass'.strtoupper($avNt['lcode']); $pFuncName = 'nxs_doPublishTo'.strtoupper($avNt['lcode']);                     
                  $po =  get_post_meta($rpstLastPostID, 'snap'.strtoupper($avNt['lcode']), true); $po =  maybe_unserialize($po); 
                  $ntClInst = new $clName(); $ntOpts['ii'] = $ii; $ntOpts['pType'] = 'aj'; $ntOptsPost = $ntClInst->adjMetaOpt($ntOpts, $po[$ii]); 
                  if ($options['extDebug']=='1') $extInfo .= "<br/><br/>NT OPTS: ".print_r($ntOptsPost, true);  if ($options['extDebug']=='1') $extInfo .= "ARGS: <br/><br/>".print_r($args, true);
                  $result = $pFuncName($rpstLastPostID, $ntOptsPost); //if ($result == 200) die("Successfully sent your post to App.Net."); else die($result);                          
                  nxs_addToLogN('S', 'RE-Posting', $logNT, 'OK  | '.$times.' | Previous Time:'.date_i18n('Y-m-d H:i:s', $lastTime).'| Next Shedulled Time - '.date_i18n('Y-m-d H:i:s', $ntOpts['rpstNxTime']).")<br/>", $extInfo);
                }
              } $options[$avNt['lcode']][$ii] = $ntOpts; // prr($ntOpts);
            }
        }      
    }
  } if ($hasChanged) { update_option($plgn_NS_SNAutoPoster->dbOptionsName, $options); $plgn_NS_SNAutoPoster->nxs_options = $options; }
}

function nxs_chckBrwsr() { $isOK = false; 
  if (preg_match('/MSIE/i',$_SERVER['HTTP_USER_AGENT'])) $isOK = true;    if (preg_match('/Internet Explorer/i',$_SERVER['HTTP_USER_AGENT'])) $isOK = true;
  if (preg_match('/Firefox/i',$_SERVER['HTTP_USER_AGENT'])) $isOK = true; if (preg_match('/Opera/i',$_SERVER['HTTP_USER_AGENT'])) $isOK = true;
  if (preg_match('/Chrome/i',$_SERVER['HTTP_USER_AGENT'])) $isOK = true;  if (preg_match('/Safari/i',$_SERVER['HTTP_USER_AGENT'])) $isOK = true;
  if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone)/i', strtolower($_SERVER['HTTP_USER_AGENT'])) || (!empty($_SERVER['HTTP_ACCEPT']) && strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml')>0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) $isOK = false;
  return $isOK;
}

//## NXS Cron
if (!function_exists("nxs_psCron")) { function nxs_psCron() { if (!is_home() && !is_front_page()) return; if (nxs_chckBrwsr()==false) return;    
   //if (stripos($_SERVER["REQUEST_URI"], 'admin-ajax.php')!==false || stripos($_SERVER["REQUEST_URI"], 'cf_action')!==false || stripos($_SERVER["REQUEST_URI"], 'wp-cron.php')!==false) return;   
   $ltc = get_option('NSX_LastTChecked'); if (empty($ltc)) { add_option("NSX_LastTChecked", time()); return; } if (time()<$ltc+300) return;  $sh =_get_cron_array();  $itmsToPush = array();   
   if (is_array($sh)) foreach ($sh as $evTime => $evDataX) foreach ($evDataX as $evFunc=>$evData) if (strpos($evFunc, 'ns_doPublishTo')!==false) { $chkTime = rand(360, 600); //$chkTime = rand(5, 7);
     if ($evTime>'1359495839' && $evTime<time()-$chkTime) $itmsToPush[] = array('time'=>$evTime);
   } if (count($itmsToPush)<1) return;  
   /*
   $snapIP = get_post_meta($toPush['args'][0], 'snap_mp_'.$toPush['func'], true); 
   nxs_addToLogN('S', 'Missed Scheduled Autoposts Found', '', ' - ('.$evTime."&lt;".(time()-$chkTime).') - Trying to Post', '');
   delete_post_meta(); add_post_meta($toPush['args'][0], 'snap_mp_'.$toPush['func'], (time()+300));
   */
   update_option("NSX_LastTChecked", time());
   $cron_url = site_url('wp-cron.php?doing_wp_cron=0'); ?><script type="text/javascript" > jQuery(document).ready(function($) { jQuery.get('<?php echo $cron_url; ?>'); }); </script><?php // die();
   return true;         
}}

if (!function_exists("nxs_addToRI")) { function nxs_addToRI($postID) { global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options;
  $riPosts = get_option('NS_SNriPosts'); if (!is_array($riPosts)) $riPosts = array();  $options['riHowManyPostsToTrack'] =  (int) $options['riHowManyPostsToTrack'];  if ($options['riHowManyPostsToTrack']==0) return;
  array_unshift($riPosts, $postID);  $riPosts = array_unique($riPosts); $riPosts = array_slice($riPosts, 0, $options['riHowManyPostsToTrack']); update_option('NS_SNriPosts', $riPosts);
}}

function nxs_activation(){ if (!wp_next_scheduled('nxs_hourly_event')){wp_schedule_event(time(), 'hourly', 'nxs_hourly_event');} if (!wp_next_scheduled('nxs_querypost_event')){wp_schedule_event(time(), 'nxsreposter', 'nxs_querypost_event');}  }
function nxs_do_this_hourly() {  $options = get_option('NS_SNAutoPoster');   
  if (isset($options['errNotifEmailCB']) && (int)$options['errNotifEmailCB'] == 1 && isset($options['errNotifEmail']) && trim($options['errNotifEmail']) != '') { $logToSend = maybe_unserialize(get_option('NSX_LogToEmail')); // echo "SSS"; 
//  prr($logToSend);
    if (is_array($logToSend) && count($logToSend)>0) { $to = $options['errNotifEmail']; $subject = "SNAP Error Log for ".$_SERVER["SERVER_NAME"]; $message = print_r($logToSend, true);
      $eml = get_bloginfo('admin_email'); if (trim($eml)=='') $eml = "snap-notify@".str_ireplace('www.','',$_SERVER["SERVER_NAME"]); 
      $headers = "From: " . $eml . "\r\n"; $headers .= "Reply-To: ". $eml . "\r\n"; $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; $retval = wp_mail($to, $subject, $message, $headers); echo ($to ."|". $subject."|". $message."|". $headers);
      if ($retval == true) nxs_addToLogN( 'S', 'Log sent to email '.$options['errNotifEmail'], 'ALL', count($logToSend).' records sent', '');  
        else nxs_addToLogN( 'ER', '[FALIED] Log sent to email '.$options['errNotifEmail'], 'ALL', count($logToSend).' records were NOT sent', '');  
      delete_option("NSX_LogToEmail");  
  }}  
  $riPosts = get_option('NS_SNriPosts'); if (!is_array($riPosts)) $riPosts = array(); //## Check for Incoming Comments if nessesary.  
  if ($options['riActive'] != 1 || count($riPosts)<1 ) return;
  if (isset($options['extDebug']) && $options['extDebug']=='1') nxs_addToLogN( 'S', 'Comments Import', 'ALL', 'Checking for new comments now...', print_r($riPosts, true));
  //## Facebook
  if (is_array($options['fb'])) foreach ($options['fb'] as $ii=>$fbo) if ($fbo['riComments']=='1') {  $fbo['ii'] = $ii; $fbo['pType'] = 'aj';
    foreach ($riPosts as $postID) {  
      $fbpo =  get_post_meta($postID, 'snapFB', true); $fbpo =  maybe_unserialize($fbpo); 
      if (is_array($fbpo) && isset($fbpo[$ii]) && is_array($fbpo[$ii]) && isset($fbpo[$ii]['pgID']) && trim($fbpo[$ii]['pgID'])!=''){ 
          $ntClInst = new nxs_snapClassFB(); $fbo = $ntClInst->adjMetaOpt($fbo, $fbpo[$ii]);  nxs_getBackFBComments($postID, $fbo, $fbpo[$ii]);
      }
    }      
  }   
  //## Twitter
  if (is_array($options['tw'])) foreach ($options['tw'] as $ii=>$fbo) if ($fbo['riComments']=='1') {  $fbo['ii'] = $ii; $fbo['pType'] = 'aj'; $twList = nxs_getBackTWCommentsList($fbo); 
    foreach ($riPosts as $postID) {  
      $fbpo =  get_post_meta($postID, 'snapTW', true); $fbpo =  maybe_unserialize($fbpo); 
      if (is_array($fbpo) && isset($fbpo[$ii]) && is_array($fbpo[$ii])  && isset($fbpo[$ii]['pgID']) && trim($fbpo[$ii]['pgID'])!=''){ 
         $ntClInst = new nxs_snapClassTW(); $fbo = $ntClInst->adjMetaOpt($fbo, $fbpo[$ii]); nxs_getBackTWComments($postID, $fbo, $fbpo[$ii], $twList);
      }
    }      
  } 
}
//#### V3 new Query Poster
function nxs_addToPostingQuery($postID){ global $plgn_NS_SNAutoPoster; if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
  $quPosts = maybe_unserialize(get_option('NSX_PostsQuery')); if (!is_array($quPosts)) $quPosts = array();  
  if (!in_array($postID, $quPosts)) $quPosts[] = $postID; update_option('NSX_PostsQuery', $quPosts);    
  //## Update Next Post time
  $currTime = time() + 10 + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ); $nxTime = !empty($options['quNxTime'])?$options['quNxTime']:0;
  if (empty($nxTime) || $nxTime < $currTime) { $options['quNxTime'] = $currTime; update_option('NS_SNAutoPoster', $options);  $plgn_NS_SNAutoPoster->nxs_options = $options; }
}
function nxs_do_post_from_query() { nxs_cron_check(); // nxs_addToLogN('A', 'Debug info only. - Cron Time', 'X', '', $extInfo);      
  if (stripos($_SERVER["REQUEST_URI"], 'wp-cron.php')!==false) nxs_rePoster(); //## Run Reposter.
  $options = get_option('NS_SNAutoPoster'); $quPosts = maybe_unserialize(get_option('NSX_PostsQuery')); if (!is_array($quPosts)) $quPosts = array();
  if ($options['quLimit'] != '1' || count($quPosts)<1) return;  $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );  $hasChanged = false; 
  $postToPost = array_shift($quPosts);   
  
  $pstEvrySec = $options['quDays']*86400+$options['quHrs']*3600+$options['quMins']*60; $rndSec = $options['quLimitRndMins']*60;  
  $nxTime = !empty($options['quNxTime'])?$options['quNxTime']:$currTime+$pstEvrySec; 
  
  $extInfo = 'Query Time:'.date_i18n('Y-m-d H:i:s', $options['quNxTime'])."|Previous Time:".date_i18n('Y-m-d H:i:s', $options['quLastShTime']);
  
  if (empty($options['quNxTime']) || $nxTime < $currTime) $hasChanged = true;  // Do Post  
       
  if ($hasChanged) { //## Do Post     
    nxs_addToLogN('A', '**POST STARTED** NXSPoster - WP CRON - Post from Query - Post ID: '.$postToPost, '', 'Curr Time: '.date_i18n('Y-m-d H:i:s', $currTime).'~', $extInfo);        
    $options['quLastShTime'] = $currTime; $rndTime = rand(0-$rndSec, $rndSec); $options['quNxTime'] = $currTime + $pstEvrySec + $rndTime;    
    if ($options['nxsOverLimit']=='D') { $dateC = date("d"); $dayN = date("d", $nxTime); if ($dayN!=$dateC) $quPosts = array(); }    
    update_option('NSX_PostsQuery', $quPosts);  update_option('NS_SNAutoPoster', $options);    
    nxs_snapPublishTo($postToPost, '', true);      
    nxs_addToLogN('A', '**POST FINISHED** NXSPoster - WP CRON - Post from Query - Post ID: '.$postToPost, '', '-=Time=- '.$currTime, $extInfo); 
  }
}

class NXS_HtmlFixer { public $dirtyhtml; public $fixedhtml; public $allowed_styles; private $matrix; public $debug; private $fixedhtmlDisplayCode;
    public function __construct() { $this->dirtyhtml = ""; $this->fixedhtml = ""; $this->debug = false; $this->fixedhtmlDisplayCode = ""; $this->allowed_styles = array();}
    public function getFixedHtml($dirtyhtml) { $c = 0; $this->dirtyhtml = $dirtyhtml; $this->fixedhtml = ""; $this->fixedhtmlDisplayCode = ""; if (is_array($this->matrix)) unset($this->matrix); $errorsFound=0;
      while ($c<10) { if ($c>0) $this->dirtyhtml = $this->fixedxhtml; $errorsFound = $this->charByCharJob(); if (!$errorsFound) $c=10;  $this->fixedxhtml=str_replace('<root>','',$this->fixedxhtml); 
        $this->fixedxhtml=str_replace('</root>','',$this->fixedxhtml); $this->fixedxhtml = $this->removeSpacesAndBadTags($this->fixedxhtml); $c++;
      } return $this->fixedxhtml;
    }
    private function fixStrToLower($m){ $right = strstr($m, '='); $left = str_replace($right,'',$m); return strtolower($left).$right;}
    private function fixQuotes($s){ $q = "\""; if (!stristr($s,"=")) return $s; $out = $s; preg_match_all("|=(.*)|",$s,$o,PREG_PATTERN_ORDER);
      for ($i = 0; $i< count ($o[1]); $i++) { $t = trim ( $o[1][$i] ) ; $lc=""; if ($t!="") { if ($t[strlen($t)-1]==">") { $lc= ($t[strlen($t)-2].$t[strlen($t)-1])=="/>"  ?  "/>"  :  ">" ; $t=substr($t,0,-1);}
        if (($t[0]!="\"")&&($t[0]!="'")) $out = str_replace( $t, "\"".$t,$out); else $q=$t[0]; if (($t[strlen($t)-1]!="\"")&&($t[strlen($t)-1]!="'")) $out = str_replace( $t.$lc, $t.$q.$lc,$out);
      }} return $out;
    }
    private function fixTag($t){  $t = preg_replace ( array( '/borderColor=([^ >])*/i', '/border=([^ >])*/i' ),  array('',''), $t);
        preg_match_all('/(?:"[^"]*"|\'[^\']*\'|[^"\'\s]+)+/', $t, $ar);  $ar = $ar[0];// prr($ar);
        $nt = ""; for ($i=0;$i<count($ar);$i++) { if (strpos($ar[$i], 'href=\\\\\\"')!==false) {$ar[$i] = str_replace('\\\\\\"','"',$ar[$i]);}
          if (strpos($ar[$i], 'href=\\"')!==false) {$ar[$i] = str_replace('\\"','"',$ar[$i]);} if (strpos($ar[$i], 'href=\"')!==false) {$ar[$i] = str_replace('\"','"',$ar[$i]);}
          $ar[$i]=$this->fixStrToLower($ar[$i]); if (stristr($ar[$i],"=")) $ar[$i] = $this->fixQuotes($ar[$i]); $nt.=$ar[$i]." ";   
        } $nt=preg_replace("/<( )*/i","<",$nt); $nt=preg_replace("/( )*>/i",">",$nt); return trim($nt);
    }
    private function extractChars($tag1,$tag2,$tutto) {  if (!stristr($tutto, $tag1)) return ''; $s=stristr($tutto,$tag1); $s=substr( $s,strlen($tag1)); if (!stristr($s,$tag2)) return '';
        $s1=stristr($s,$tag2); return substr($s,0,strlen($s)-strlen($s1));
    }
    private function mergeStyleAttributes($s) { $x = ""; $temp = ""; $c = 0;
        while(stristr($s,"style=\"")) {$temp = $this->extractChars("style=\"","\"",$s); if ($temp=="") { return preg_replace("/(\/)?>/i","\"\\1>",$s);}
            if ($c==0) $s = str_replace("style=\"".$temp."\"","##PUTITHERE##",$s); $s = str_replace("style=\"".$temp."\"","",$s); if (!preg_match("/;$/i",$temp)) $temp.=";"; $x.=$temp; $c++;
        }
        if (count($this->allowed_styles)>0) { $check=explode(';', $x); $x=""; foreach($check as $chk){ foreach($this->allowed_styles as $as) if(stripos($chk, $as) !== False) { $x.=$chk.';'; break; } }}
        if ($c>0) $s = str_replace("##PUTITHERE##","style=\"".$x."\"",$s);return $s;
    }
    private function fixAutoclosingTags($tag,$tipo=""){ if (in_array( $tipo, array ("img","input","br","hr")) ) { if (!stristr($tag,'/>')) $tag = str_replace('>','/>',$tag ); } return $tag; }
    private function getTypeOfTag($tag) { $tag = trim(preg_replace("/[\>\<\/]/i","",$tag)); $a = explode(" ",$tag); return $a[0];}
    private function checkTree() { $errorsCounter = 0; for ($i=1;$i<count($this->matrix);$i++) { $flag=false;
      if ($this->matrix[$i]["tagType"]=="div") { $parentType = $this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]; if (in_array($parentType, array("p","b","i","font","u","small","strong","em"))) $flag=true; }
      if (in_array( $this->matrix[$i]["tagType"], array( "b", "strong" )) ) {  $parentType = $this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]; if (in_array($parentType, array("b","strong"))) $flag=true; }
      if (in_array( $this->matrix[$i]["tagType"], array ( "i", "em") )) {  $parentType = $this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]; if (in_array($parentType, array("i","em"))) $flag=true; }
      if ($this->matrix[$i]["tagType"]=="p") { $parentType = $this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]; if (in_array($parentType, array("p","b","i","font","u","small","strong","em"))) $flag=true; }
      if ($this->matrix[$i]["tagType"]=="table") { $parentType = $this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]; if (in_array($parentType, array("p","b","i","font","u","small","strong","em","tr","table"))) $flag=true; }
      if ($flag) { $errorsCounter++; if ($this->debug) echo "<div style='color:#ff0000'>Found a <b>".$this->matrix[$i]["tagType"]."</b> tag inside a <b>".htmlspecialchars($parentType)."</b> tag at node $i: MOVED</div>";                
        $swap = $this->matrix[$this->matrix[$i]["parentTag"]]["parentTag"]; if ($this->debug) echo "<div style='color:#ff0000'>Every node that has parent ".$this->matrix[$i]["parentTag"]." will have parent ".$swap."</div>";
        $this->matrix[$this->matrix[$i]["parentTag"]]["tag"]="<!-- T A G \"".$this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]."\" R E M O V E D -->"; $this->matrix[$this->matrix[$i]["parentTag"]]["tagType"]="";
        $hoSpostato=0;for ($j=count($this->matrix)-1;$j>=$i;$j--) { if ($this->matrix[$j]["parentTag"]==$this->matrix[$i]["parentTag"]) { $this->matrix[$j]["parentTag"] = $swap; $hoSpostato=1; }}
      }}return $errorsCounter;
    }
    private function findSonsOf($parentTag) { $out= "";
      for ($i=1;$i<count($this->matrix);$i++) { if ($this->matrix[$i]["parentTag"]==$parentTag) {
          if ($this->matrix[$i]["tag"]!="") { $out.=$this->matrix[$i]["pre"]; $out.=$this->matrix[$i]["tag"]; $out.=$this->matrix[$i]["post"]; } else { $out.=$this->matrix[$i]["pre"]; $out.=$this->matrix[$i]["post"];}
          if ($this->matrix[$i]["tag"]!="") { $out.=$this->findSonsOf($i); if ($this->matrix[$i]["tagType"]!="") { if (!in_array($this->matrix[$i]["tagType"], array ( "br","img","hr","input"))) $out.="</". $this->matrix[$i]["tagType"].">";}}
      }}return $out;
    }
    private function findSonsOfDisplayCode($parentTag) { $out= "";
        for ($i=1;$i<count($this->matrix);$i++) {
            if ($this->matrix[$i]["parentTag"]==$parentTag) { $out.= "<div style=\"padding-left:15\"><span style='float:left;background-color:#FFFF99;color:#000;'>{$i}:</span>";
                if ($this->matrix[$i]["tag"]!="") { if ($this->matrix[$i]["pre"]!="") $out.=htmlspecialchars($this->matrix[$i]["pre"])."<br>";
                    $out.="".htmlspecialchars($this->matrix[$i]["tag"])."<span style='background-color:red; color:white'>{$i} <em>".$this->matrix[$i]["tagType"]."</em></span>";
                    $out.=htmlspecialchars($this->matrix[$i]["post"]);
                } else { if ($this->matrix[$i]["pre"]!="") $out.=htmlspecialchars($this->matrix[$i]["pre"])."<br>"; $out.=htmlspecialchars($this->matrix[$i]["post"]);}
                if ($this->matrix[$i]["tag"]!="") { $out.="<div>".$this->findSonsOfDisplayCode($i)."</div>\n";
                    if ($this->matrix[$i]["tagType"]!="") {
                        if (($this->matrix[$i]["tagType"]!="br") && ($this->matrix[$i]["tagType"]!="img") && ($this->matrix[$i]["tagType"]!="hr")&& ($this->matrix[$i]["tagType"]!="input"))
                            $out.="<div style='color:red'>".htmlspecialchars("</". $this->matrix[$i]["tagType"].">")."{$i} <em>".$this->matrix[$i]["tagType"]."</em></div>";
                    }
                } $out.="</div>\n";
            }
        }return $out;
    }
    private function removeSpacesAndBadTags($s) { $i=0;
      while ($i<10) { $i++; $s = preg_replace (
        array( '/  /i', '/<p([^>])*>(&nbsp;)*\s*<\/p>/i', '/<span([^>])*>(&nbsp;)*\s*<\/span>/i', '/<strong([^>])*>(&nbsp;)*\s*<\/strong>/i', '/<em([^>])*>(&nbsp;)*\s*<\/em>/i',
          '/<font([^>])*>(&nbsp;)*\s*<\/font>/i', '/<small([^>])*>(&nbsp;)*\s*<\/small>/i', '/<\?xml:namespace([^>])*><\/\?xml:namespace>/i', '/<\?xml:namespace([^>])*\/>/i', '/class=\"MsoNormal\"/i',
          '/<o:p><\/o:p>/i', '/<!DOCTYPE([^>])*>/i', '/<!--(.|\s)*?-->/', '/<\?(.|\s)*?\?>/'), 
        array(' ', ' ', '', '', '', '', '', '', '', '', '', ' ', '', '' ) , trim($s));
      }return $s;
    }
    private function charByCharJob() { $s = $this->removeSpacesAndBadTags($this->dirtyhtml); if ($s=="") return; //echo "\r\n=!= ".$s." =!=\r\n<br/>\r\n";
        $s = "<root>".$s."</root>"; $contenuto = ""; $ns = ""; $i=0; $j=0; $ss=''; $indexparentTag=0; $padri=array(); array_push($padri,"0"); $this->matrix[$j]["tagType"]="";
        $this->matrix[$j]["tag"]=""; $this->matrix[$j]["parentTag"]="0"; $this->matrix[$j]["pre"]=""; $this->matrix[$j]["post"]=""; $tags=array();
        // echo "\r\n=#= ".$s." =#=\r\n<br/>\r\n";
        while($i<strlen($s)) {
            if ( $s[$i] =="<") { $contenuto = $ns; $ns = ""; $tag=""; while( $i<strlen($s) && $s[$i]!=">" ){ $tag.=$s[$i]; $i++;} $tag.=$s[$i]; if (stristr($tag,'<param') && stristr($tag,'/>')) $tag = str_replace('/>','></param>',$tag);
            $ss .= $tag;                 
        } else $ss .= $s[$i]; $i++; }
        $i=0; $s = $ss; //echo "\r\n== ".$s." ==\r\n<br/>\r\n";
        while($i<strlen($s)) {
            if ( $s[$i] =="<") { $contenuto = $ns; $ns = ""; $tag=""; while( $i<strlen($s) && $s[$i]!=">" ){ $tag.=$s[$i]; $i++;} $tag.=$s[$i];                
                if($s[$i]==">") { $tag = $this->fixTag($tag); $tagType = $this->getTypeOfTag($tag); $tag = $this->fixAutoclosingTags($tag,$tagType);
                    $tag = $this->mergeStyleAttributes($tag); if (!isset($tags[$tagType])) $tags[$tagType]=0; $tagok=true;
                    if (($tags[$tagType]==0)&&(stristr($tag,'/'.$tagType.'>'))&&(stristr($tag,'<'.$tagType)!==false)) { $tagok=false; if ($this->debug) echo "<div style='color:#ff0000'>Found a closing tag <b>".htmlspecialchars($tag)."</b> at char $i without open tag: REMOVED</div>";} else $tagok=true;
                }
                if ($tagok) { $j++; $this->matrix[$j]["pre"]=""; $this->matrix[$j]["post"]=""; $this->matrix[$j]["parentTag"]=""; $this->matrix[$j]["tag"]=""; $this->matrix[$j]["tagType"]="";
                    if (stristr($tag,'/'.$tagType.'>')) { $ind = array_pop($padri); $this->matrix[$j]["post"]=$contenuto; $this->matrix[$j]["parentTag"]=$ind; $tags[$tagType]--;
                    } else { if (@preg_match("/".$tagType."\/>$/i",$tag)||preg_match("/\/>/i",$tag)) { $this->matrix[$j]["tagType"]=$tagType; $this->matrix[$j]["tag"]=$tag;
                      $indexparentTag = array_pop($padri); array_push($padri,$indexparentTag); $this->matrix[$j]["parentTag"]=$indexparentTag; $this->matrix[$j]["pre"]=$contenuto; $this->matrix[$j]["post"]="";
                    } else { $tags[$tagType]++; $this->matrix[$j]["tagType"]=$tagType; $this->matrix[$j]["tag"]=$tag; $indexparentTag = array_pop($padri); array_push($padri,$indexparentTag);
                      array_push($padri,$j); $this->matrix[$j]["parentTag"]=$indexparentTag; $this->matrix[$j]["pre"]=$contenuto; $this->matrix[$j]["post"]=""; }
                    }
                }
            } else { $ns.=$s[$i]; } $i++;
        } for ($eli=$j+1;$eli<count($this->matrix);$eli++) { $this->matrix[$eli]["pre"]=""; $this->matrix[$eli]["post"]=""; $this->matrix[$eli]["parentTag"]=""; $this->matrix[$eli]["tag"]=""; $this->matrix[$eli]["tagType"]="";}
        $errorsCounter = $this->checkTree();  $this->fixedxhtml=$this->findSonsOf(0);return $errorsCounter;
    }
}

//## parse_str() implementation - max_vars fix.
if (!function_exists("NXS_doSetArrRecursive")) { function NXS_doSetArrRecursive(&$array, $path, $value){ $key = array_shift($path); //prr($path); prr($key); echo "|-"; prr($array); echo "-|";
  if (empty($path)) if (trim($key)=='')  $array[] = $value;  else  $array[$key] = $value; else { if (!isset($array[$key]) || !is_array($array[$key])) $array[$key] = array(); NXS_doSetArrRecursive($array[$key], $path, $value); }
}}
if (!function_exists("NXS_parseQueryStr")) { function NXS_parseQueryStr($url){ $tokens = explode("&", $url); $urlVars = array();
  foreach ($tokens as $token) { $token = urldecode($token); $value = NXS_parseEQStr($token, "=", ""); 
    if (preg_match('/^([^\[]*)(\[.*\])$/', $token, $matches)) { if (preg_match_all('/\[([^\]]*)\]/', $matches[2], $matches2)) $gg = $matches2[1]; array_unshift($gg, $matches[1]); NXS_doSetArrRecursive($urlVars, $gg, $value);} 
      else $urlVars[$token] = $value;
  } return $urlVars;
}}
if (!function_exists("NXS_parseEQStr")) { function NXS_parseEQStr(&$a, $delim='.', $default=false){ $n = strpos($a, $delim); if ($n === false) return $default; $result = substr($a, $n+strlen($delim)); $a = substr($a, 0, $n); return $result;}}
?>