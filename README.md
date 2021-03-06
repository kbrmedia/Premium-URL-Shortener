Premium-URL-Shortener
=====================

This repository is used to share plugins, languages and other stuff for verified buyers. You can buy Premium URL Shortener at http://gempixel.com/buy/short

## Found an issue?
If you have found an issue with the main script, open an "Issue" and we will resolve it as soon as possible.

## Help Contribute
Send us pull requests and help improve the code.

Premium URL Shortener PHP API Wrapper
==================

The official API wrapper for [Premium URL Shortener](https://gempixel.com/demo/short/)

## Your first integration
The example below shows you how to shorten a URL without any other parameters. You need to get your API key from the settings page of the user control panel

```php
include("API/Shortener.php");

$shortener = new kbrmedia\Shortener();

// Set the URL & API key
$shortener->setURL("http://myshort.site/api");
$shortener->setKey("APIKEY");

// Simple call
echo $shortener->shorten("https://gempixel.com");
```
## Get short URL directly
To get the Short URL directly without having to deal with json you can chain the getShort() method as below

```php
// Get short URL directly
echo $shortener->getShort()->shorten("https://gempixel.com");
```

## Advanced Call
To customize the URL, you can use the below to set a custom alias and the format - which in this case is in text

```php
// Custom Alias
$shortener->setCustom("gempixel");

// Format: text or json
$shortener->setFormat("text");

echo $shortener->shorten("https://gempixel.com");
```
## Unshorten a URL or Get more data
This sample allows you to unshorten a URL and some data 

```php
echo $shortener->unshorten("http://myshort.site/gempixel");
```
