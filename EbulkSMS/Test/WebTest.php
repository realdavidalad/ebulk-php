<?php

namespace EbulkSMS\Test;

//require ('../../vendor/autoload.php');

use EbulkSMS\Authentication\Initialize;
use EbulkSMS\Response\Response;
use EbulkSMS\Request\SendSMS;


//use PHPUnit_Framework_TestCase;





	 try{

		$Initialize=new Initialize([
			'Key'=>'4c8260b451691cdbb07dfa8e47a994bdcd412b51',
			 'Username'=>'smilesteadily@gmail.com'
			]);

		SendSMS::sendWithJSON(['SenderName'=>'ebulk-php',
			'Recipients'=>'08062458700',
			'Message'=>'Hello ebulk-php'
		]);


		if(Response::$getResposeCode==200){

			echo Response::$getResposeCode.'. '.Response::$getSuccessMessage;

		}else{

			echo Response::$getResposeCode.'. '.Response::$getErrorMessage;

		}

	 }
	 catch(Exception $e){

	 	echo $e->getMessage();
	 }


	