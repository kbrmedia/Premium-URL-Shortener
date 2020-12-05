<?php
/**
 * Include the main class
 */
include("Shortener.php");
/**
 * Instantiate it + Set the URL & API key
 * @var kbrmedia
 */
$shortener = new GemPixel\Shortener('URL', 'KEY');

/**
 * Create a new short url
 * @param array $urlData Array of url data
 */

$urlData = [
  'url' => 'https://google.com',
  'custom' => 'google365',
  'password' => 'mypass',
  'domain' => 'http://goo.gl',
  'expiry' => '2020-11-11 12:00:00',
  'type' => 'splash',
  'geotarget' => [
    [
      'location' => 'Canada',
      'link' => 'https://google.ca',
    ],
    [
      'location' => 'United States',
      'link' => 'https://google.us',
    ]
  ],
  'devicetarget' => [
    [
      'device' => 'iPhone',
      'link' => 'https://google.com',
    ],
    [
      'device' => 'Android',
      'link' => 'https://google.com',
    ]
  ]
];

$shortener->shorten($urlData);


/**
 * Get Details & Stats
 * @param integer $urlid The ID of the url
 */

$shortener->stats($urlid);

/**
 * Get all of your URLS
 * @param integer $page Current page number
 * @param string $sort Sort your URLs between "date" or "click" (optional - default = date)
 * @param integer $limit Limit number of URLs
 */

$shortener->account(int $page, array $order, int $limit);


/**
 * Create a new User (Admin Only)
 * @param array $userData Array of user data
 */

$userData = [
						  'username' => 'user',
						  'password' => '1234567891011',
						  'email' => 'demo@yourwebsite.com',
						  'planid' => 1,
						  'expiration' => '2020-11-20 11:00:00',
						];

$shortener->createUser($userData);


/**
 * Get user information (Admin Only)
 * @param integer $userID User ID
 */
$shortener->getUser($userID);
