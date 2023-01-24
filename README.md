# godaddy-php-sdk

A PHP SDK for GoDaddy

**Supported PHP Versions**: This SDK works with PHP 7.4.0+.

## Installation

### To install Composer
#### Globally in Mac

1. Download the latest version of [Composer](https://getcomposer.org/download/). 
2. Run the following command in Terminal: 
        
        $ php ~/Downloads/composer.phar --version

3. Run the following command to make it executable:
        
        $ cp ~/Downloads/composer.phar /usr/local/bin/composer
        $ sudo chmod +x /usr/local/bin/composer
        $ Make sure you move the file to bin directory.

4. To check if the path has **/usr/local/bin**, use 
        
        $ echo $PATH

   If the path is different, use the following command to update the $PATH:    
            
        $ export PATH = $PATH:/usr/local/bin
        $ source ~/.bash_profile 

4. You can also check the version of Composer by running the following command:
        
        $ composer --version.       

#### Globally in Linux

1. Run the following command:
        
        $ curl -sS https://getcomposer.org/installer | php

2. Run the following command to make the composer.phar file as executable:
        
        $ chmod +x composer.phar

3. Run the following command to make Composer globally available for all system users:
        
        $ mv composer.phar /usr/local/bin/composer

#### Windows 10

1. Download and run the [Windows Installer](https://getcomposer.org/download/) for Composer.

    **Note:** Make sure to allow Windows Installer for Composer to make changes to your **php.ini** file.

2. If you have any terminal windows open, close all instances and open a fresh terminal instance.
3. Run the Composer command.
        
        $ composer -V

### Steps to install GoDaddy Package

- To install the **stable release**, run the following command in the project directory:
        
        $ composer require bmcfarlin/godaddy-php-sdk

- To install a **specific release**, run the following command in the project directory:
        
        $ composer require bmcfarlin/godaddy-php-sdk:1.0.0

- Alternatively, you can download this source and run
        
        $ composer install

This generates the autoload files, which you can include using the following line in your PHP source code to start using the SDK.

```php
<?php
require 'vendor/autoload.php'
```

## Getting started

### Authentication

To make the API requests, you need to create a `Client` and provide it with authentication credentials (which can be found at [https://godaddy.com/](https://godaddy.com/)).

We recommend that you store your credentials in the `GODADDY_API_KEY`, `GODADDY_API_SECRET` and the `GODADDY_API_URL` environment variables, so as to avoid the possibility of accidentally committing them to source control. If you do this, you can initialise the client with no arguments and it will automatically fetch them from the environment variables:

```php
<?php
require 'vendor/autoload.php';
use GoDaddy\Client;

$client = new Client();
```

Alternatively, you can specifiy the authentication credentials while initializing the `Client`.

```php
<?php
require 'vendor/autoload.php';
use GoDaddy\Client;

$client = new Client("your_api_key", "your_api_secret", "your_api_url");
```

## The Basics
The SDK uses consistent interfaces to create, retrieve, update, delete and list domain. The pattern followed is as follows:

```php
<?php
$client->domain->list()
$client->domain->get($domain)
$client->domain->record->list($domain)
$client->domain->record->get($domain, $type, $name)
$client->domain->record->create($domain, $type, $name, $value)
$client->domain->record->update($domain, $type, $name, $value)
$client->domain->record->delete($domain, $type, $name)
```
Also, using `$client->domain->list()` would list the first 200 domain by default (which is the first page, with `size` as 200, and `page` as 1). To get more, you will have to use `size` and `page` to get the second page of domain.

## Reporting issues
Report any feedback or problems with this version by [opening an issue on Github](https://github.com/bmcfarlin/godaddy-php-sdk/issues).


