<?php
/**
 * Include the main class
 */
include("Shortener.php");
/**
 * Instantiate it
 * @var kbrmedia
 */
$shortener = new kbrmedia\Shortener();
/**
 * Set the URL & API key
 */
$shortener->setURL("http://url.kbr/api");
$shortener->setKey("Fgvsld81Hvex");
/**
 * Simple call
 */
echo $shortener->shorten("https://gempixel.com");

/**
 * Get short URL directly
 */
echo $shortener->getShort()->shorten("https://gempixel.com");

/**
 * Advanced call
 */
// Custom Alias
$shortener->setCustom("gempixel");

// Set Type
$shortener->setType("frame");

// Set Password
$shortener->setPassword("123456");

// Format: text or json
$shortener->setFormat("text");

echo $shortener->shorten("https://gempixel.com");


/**
 * Get Details & Stats
 */

var_dump($shortener->details("gempixel"));

/**
 * Get all of your URLS
 * @param string $sort Sort your URLs between "date" or "click" (optional - default = date)
 * @param integer $limit Limit number of URLs
 */
var_dump($shortener->urls());
