<?php

namespace EbulkSMS\Request;


use EbulkSMS\Utils\EbulkUtils as EbulkUtils;

use EbulkSMS\Authentication\Initialize as Initialize;

use EbulkSMS\Response\Response as Response;




class SendSMS extends Initialize {


	public static function sendWithJSON($data){

		// $response= new Response;

		 //$init=new Initialize();


		try{
                  
            if (get_magic_quotes_gpc()) {
                  $Message = stripslashes($data['Message']);
              }
              $Message = substr($data['Message'], 0, 160);

            #Use the next line for HTTP POST with JSON

            $ReturnMessage = EbulkUtils::useJSON(Initialize::getJSONUrl(), Initialize::getUserName(),Initialize::getAPIKey(),Initialize::getFlash(), $data['SenderName'], $data['Message'], $data['Recipients']);

            if($ReturnMessage =="SUCCESS"){

            	Response::$getSuccessMessage=$ReturnMessage;

            	Response::$getResposeCode=200;

            }else{

            	throw new Exception($ReturnMessage, 400);
            	
            }



        }

        catch(Exception $e){

        	Response::$getCode=$e->getCode();

        	Response::$getErrorMessage=$e->getMessage();
        }


	}

	public static function sendWithXML($data){

	//	$response= new Response;

		try{
                  
                  if (get_magic_quotes_gpc()) {
                      $Message = stripslashes($Message);
                  }
                  $Message = substr($Message, 0, 160);

              	 #Use the next line for HTTP POST with XML
             
                $ReturnMessage = EbulkUtils::useXML(Initialize::getXMLUrl(), Initialize::getUserName(),Initialize::Key,Initialize::getFlash(), $data['SenderName'], $data['Message'], $data['Recipients']);

                if($return =="SUCCESS"){

            		Response::$getSuccessMessage=$ReturnMessage;

            		Response::$getResponseCode=200;

            	}else{

            		throw new Exception($ReturnMessage, 400);

            	}

            }

        catch(Exception $e){

        	Response::$getResponseCode=$e->getCode();

        	Response::$getErrorMessage=$e->getMessage();
        }


	}


}
