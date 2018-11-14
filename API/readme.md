Premium URL Shortener PHP API Wrapper
==================

The official API wrapper for [Premium URL Shortener](https://gempixel.com/products/url-shortener-script/)

## Help Contribute
Send us pull requests and help improve the code.

## Your first integration
The example below shows you how to shorten a URL without any other parameters. You need to get your API key from the settings page of the user control panel

```php
include("Shortener.php");

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

// Set Type
$shortener->setType("frame");

// Set Password
$shortener->setPassword("123456");

// Format: text or json
$shortener->setFormat("text");

echo $shortener->shorten("https://gempixel.com");
```
## Get detail or data for a short URL
This sample allows you to unshorten a URL and some data 

```php
echo $shortener->details("gempixel");
```
## Get all of your URLs on your account
This sample allows you to get all of your URLs in your account. It has two parameters: sort [date or click] and limit (number of urls)

```php
echo $shortener->urls();
```
