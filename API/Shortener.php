<?php 
/**
 * @package PremiumURLShortener
 * @author KBRmedia (http://gempixel.com)
 * @copyright 2018 KBRmedia
 * @license http://gempixel.com/license
 * @link http://gempixel.com  
 * @since 1.0
 */

namespace kbrmedia;

class Shortener{
	/**
	 * API Key
	 * @var null
	 */
	protected $key = NULL;
	/**
	 * API URL
	 * @var null
	 */
	protected $url = NULL;
	/**
	 * Custom Alias
	 * @var null
	 */
	protected $custom = NULL;
	/**
	 * Format: json or text
	 * @var [type]
	 */
	protected $format = "json";
	/**
	 * Get Short directly
	 * @var boolean
	 */
	protected $getShort = FALSE;

	/**
	 * [__construct description]
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 */
	public function __construct(){}
	/**
	 * Set API URL
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $url The URL to the API
	 * @example http://mysite.com/api The URL to the API without trailing slash
	 */
	public function setURL(string $url){
		$this->url = rtrim($url, "/");		
	}
	/**
	 * Set API key
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $key Your API key
	 */
	public function setKey(string $key){
		$this->key = trim($key);	
	}
	/**
	 * Custom Alias
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $alias [description]
	 */
	public function setCustom(string $alias){
		$this->custom = trim($alias);	
	}
	/**
	 * Response Format
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $alias [description]
	 */
	public function setFormat(string $format){
		if(in_array($format, ["text","json"])){
			$this->format = trim($format);	
		}
	}	
	/**
	 * Get Short Directly
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @return  [type] [description]
	 */
	public function getShort(){
		$this->getShort = TRUE;
		return $this;
	}
	/**
	 * Shorten Request
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $url [description]
	 * @return  [type]      [description]
	 */
	public function shorten(string $url){
		$url = trim($url);

		// Validate URL
		if(!filter_var($url,FILTER_VALIDATE_URL)) die(json_encode(["error" => "1", "msg" => "Please enter a valid URL."]));

		$url = urlencode($url);

		$apicall = "{$this->url}?key={$this->key}&url={$url}";

		if(!is_null($this->custom)){
			$apicall .= "&custom={$this->custom}";
		}

		if($this->format != "json"){
			$apicall .= "&format={$this->format}";
		}
		
		$Response = $this->http($apicall);

		if($this->getShort && $this->format == "json"){
			$reponse_decoded = json_decode($Response);
			if(isset($reponse_decoded->short)){
				return $reponse_decoded->short;
			}
		}

		return $Response;
	}
	/**
	 * Unshorten URL
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $url [description]
	 * @return  [type]      [description]
	 */
	public function unshorten(string $url){
		$url = trim($url);

		// Validate URL
		if(!filter_var($url,FILTER_VALIDATE_URL)) die(json_encode(["error" => "1", "msg" => "Please enter a valid URL."]));

		$url = urlencode($url);

		$apicall = "{$this->url}?key={$this->key}&short={$url}";

		return $this->http($apicall);
	}	
	/**
	 * Make a request Call
	 * @author KBRmedia <http://gempixel.com>
	 * @version 1.0
	 * @param   string $url
	 * @return  string 
	 */
  private function http(string $url){
    $curl = curl_init();    
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
  }

}
