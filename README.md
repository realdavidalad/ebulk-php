# ebulk-php

[![Build Status](https://secure.travis-ci.org/Aladeusi/ebulk-php.png?branch=master)](https://travis-ci.org/Aladeusi/ebulk-php)
[![license](https://img.shields.io/github/license/Aladeusi/ebulk-php.svg)]()

[![Packagist](https://img.shields.io/packagist/v/Aladeusi/aladeusi/ebulk-php.svg)]()

ebulk-php is a library for using the [Ebulk SMS](http://ebulksms.com) API from PHP.

This library is first and designed to make  Ebulk API consumption seamless. 

## Installation

To install using composer
```
composer require aladeusi/ebulk-php=dev-master
```

Navigate to your root directory and update composer to install ebulk-php dependencies

```
composer update
```

## Usage

### Import Classes

Require composer autoload file and import Initialize, SendMessage and Response classes

```php
    require ('vendor/autoload.php');

    use EbulkSMS\Authentication\Initialize;
    use EbulkSMS\Response\Response;
    use EbulkSMS\Request\SendSMS;

```
### Initialize the Libary
First you initialize the library with your API key. This key can be retrived from your evulk account dashboard

```php
$Initialize=new Initialize([
    'Key'=>'YourAPIKey',
    'Username'=>'YourEbulkUserName'
    ]);
```



### Send SMS

You can either send sms in JSON format or XML format.

#### In JSON Format
```php
    SendSMS::sendWithJSON(['SenderName'=>'YourCustomSenderName',
            'Recipients'=>'RecipientsPhoneNumbersSeparatedWithComma',
            'Message'=>'YourCustomMessage'
        ]);
```

#### In XML Format
```php
    SendSMS::sendWithXML(['SenderName'=>'YourCustomSenderName',
            'Recipients'=>'RecipientsPhoneNumbersSeparatedWithComma',
            'Message'=>'YourCustomMessage'
        ]);
```

### Get Response Message and Code

#### Response Code
```php
    Response::$getResposeCode
```
#### Response Success Message
```php
    Response::$getSuccessMessage
```

#### Response Error Message
```php
    Response::$getErrorMessage
```

