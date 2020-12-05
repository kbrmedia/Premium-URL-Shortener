<?php 
/**
 * @package PremiumURLShortener
 * @author GemPixel (https://gempixel.com)
 * @copyright 2020 KBRmedia
 * @license https://gempixel.com/license
 * @link https://gempixel.com  
 * @since 2.0
 */

namespace GemPixel;

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
	 * Endpoint
	 * @var null
	 */
	protected $endpoint = NULL;
	/**
	 * HTTP Data
	 * @var array
	 */
	protected $data = [];
	/**
	 * [__construct description]
	 * @author KBRmedia <http://gempixel.com>
	 * @version 2.0
	 */
	public function __construct(string $url, string $key){
		$this->url = rtrim($url, "/");	
		$this->key = trim($key);	
	}
	/**
	 * Shorten Request
	 * @author KBRmedia <http://gempixel.com>
	 * @version 2.0
	 * @param   array $url [description]
	 * @return  [type]      [description]
	 */
	public function shorten(array $data) : object {
		$this->endpoint = 'url/add';
		$this->data = $data;
		return $this->http();		
	}
	/**
	 * URL Details & Stats
	 * @author KBRmedia <http://gempixel.com>
	 * @version 2.0
	 * @return  [type]        [description]
	 */
	public function stats(int $urlid) : object {
		
		$this->endpoint = 'url/stats';
		$this->data = [
				'urlid' => $urlid
		];
		return $this->http();		
	
	}

	/**
	 * Get all URLs from your account
	 * @author KBRmedia <http://gempixel.com>
	 * @version 2.0
	 * @return  [type] [description]
	 */
	public function account($page = 1, $order = "date", $limit = 10) : object {		

		$this->endpoint = 'url/get';
		$this->data = [
				'limit' => $limit,
				'page' => $page,
				'order' => 'date'
		];
		return $this->http();
	}
	/**
	 * Create User: Admin Only
	 * @author GemPixel <https://gempixel.com>
	 * @version 1.0
	 * @param   array  $data [description]
	 * @return  [type]       [description]
	 */
	public function createUser(array $data){
		$this->endpoint = 'user/create';
		$this->data = $data;
		return $this->http();	
	}
	/**
	 * Get User
	 * @author GemPixel <https://gempixel.com>
	 * @version 1.0
	 * @param   int    $userid [description]
	 * @return  [type]         [description]
	 */
	public function getUser(int $userid){
		$this->endpoint = 'user/get';
		$this->data = [
				'userid' => $userid,
		];
		return $this->http();		
	}
	/**
	 * Make a request Call
	 * @author GemPixel <https://gempixel.com>
	 * @version 2.0
	 * @return  [type]           [description]
	 */
	private function http(){
		$curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $this->url.'/api/'.$this->endpoint);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
    curl_setopt($curl, CURLOPT_MAXREDIRS, 2);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS , json_encode($this->data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
																				      "Authorization: Token {$this->key}",
																				      "Content-Type: application/json",
																				    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);		
	}
}
