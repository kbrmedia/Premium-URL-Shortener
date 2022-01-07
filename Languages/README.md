Languages for Premium URL Shortener
===================================

Language files shared and updated by our community.


## Want to contribute?
Send us pull requests and help improve the language files.


## How to install a language file?

Download the file from here then upload in the following directory **storage/languages/**. That is it. It is that simple. Some of these files might not be translated 100%.

## How to language files from v5.X on v6.X?

It is still possible to install language files from the previous version to the new version. 

### 1. Create a directory in the folder storage/languages with the code of the language

Create a directory in the folder storage/languages with the code of the language. Let's take French as example. The first two letters of French is fr so we will create a folder named 'fr' in storage/languages/

### 2. Add the file fr.php and rename it to app.php

### 3. Edit the file app.php

Open app.php and you will see something like this
```php
<?php
/*
 * Language: Français
 * Author: KBRmedia
 * Author URI: http://gempixel.com
 * Translator: Google
 * Date: 2020-06-19
 * ---------------------------------------------------------------
 * Important Notice: Make sure to only change the right-hand side
 * DO NOT CHANGE THE LEFT-HAND SIDE
 * Edit the text between double-quotes "DONT EDIT"=> "" on the right side
 * Make sure to not forget any quotes " and the comma , at the end
 * ---------------------------------------------------------------
 */ 

$lang = [
```

Replace that by 

```php
<?php
return [
    /**
     * Language Information
     */
    "code" => "fr",
    "region" => "fr",
    "name" => "French",
    "author" => "Name",
    "date" => "17/05/2020",
    /**
     * Language Data
     */
    "data" => [
```

then at the very end of the file replace ]; by ] ];
