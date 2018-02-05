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

// Format: text or json
$shortener->setFormat("text");

echo $shortener->shorten("https://gempixel.com");


/**
 * Unshorten call
 */

echo $shortener->unshorten("http://url.kbr/gempixel");
