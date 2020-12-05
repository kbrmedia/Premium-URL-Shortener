Premium URL Shortener PHP API Wrapper
==================

The official API wrapper for [Premium URL Shortener](https://gempixel.com/products/url-shortener-script/)

## Help Contribute
Send us pull requests and help improve the code.

## Your first integration
The example below shows you how to shorten a URL without any other parameters. You need to get your API key from the settings page of the user control panel. For more info [View Docs](https://gempixel.com/docs/premium-url-shortener)

```php
include("Shortener.php");

// Set the URL & API key
$shortener = new GemPixel\Shortener('URL', 'KEY');

/**
 * Create a new short url
 * @param array $urlData Array of url data
 */

$urlData = [
  'url' => 'https://google.com',
  'custom' => 'google',
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
```

## Get detail or data for a short URL
This sample allows you to unshorten a URL and some data. You need to send urlid

```php
/**
 * Get Details & Stats
 * @param integer $urlid The ID of the url
 */

$shortener->stats($urlid);
```
## Get all of your URLs on your account
This sample allows you to get all of your URLs in your account. It has 3 parameters: page (current page), sort [date or click] and limit (number of urls)

```php
/**
 * Get all of your URLS
 * @param integer $page Current page number
 * @param string $sort Sort your URLs between "date" or "click" (optional - default = date)
 * @param integer $limit Limit number of URLs
 */

$shortener->account(int $page, array $order, int $limit);
```

## Create a new User (admin api key only)
This sample allows you to create a new user.

```php
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
```
## Get user data (admin api key only)
This sample allows you to get user data.

```php
/**
 * Get user information (Admin Only)
 * @param integer $userID User ID
 */
$shortener->getUser($userID);
```
