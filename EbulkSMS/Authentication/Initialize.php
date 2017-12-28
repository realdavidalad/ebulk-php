<?php

namespace EbulkSMS\Authentication;


class Initialize {


	public static $JSONUrl=null;

	private static $XMLUrl;

	private static $Key=null;

	private static $Username=null;

	private static $Flash=0;


	public function __construct($data){

		self::$JSONUrl = "http://api.ebulksms.com:8080/sendsms.json";

		self::$XMLUrl = "http://api.ebulksms.com:8080/sendsms.xml";
		
		self::$Key = $data['Key'];

		self::$Username = $data['Username'];


	}


	public static function getJSONUrl(){

		return self::$JSONUrl;
	}

	public static function getXMLUrl(){

		return self::$XMLUrl;
	}

	public static function getUserName(){

		return self::$Username;
	}

	public static function getFlash(){

		return self::$Flash;
	}

	public static function getAPIKey(){

		return self::$Key;
	}

	

}
