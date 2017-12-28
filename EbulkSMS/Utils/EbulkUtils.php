<?php

namespace EbulkSMS\Utils;

/**
* 
*/
class EbulkUtils
{
	
	public function __construct()
	{
		//
	}


	//SMS gateway RestFul API functions

    public static function useJSON($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
    $gsm = array();
    $country_code = '234';
    $arr_recipient = explode(',', $recipients);
    foreach ($arr_recipient as $recipient) {
      $mobilenumber = trim($recipient);
      if (substr($mobilenumber, 0, 1) == '0'){
          $mobilenumber = $country_code . substr($mobilenumber, 1);
      }
      elseif (substr($mobilenumber, 0, 1) == '+'){
          $mobilenumber = substr($mobilenumber, 1);
      }
      $generated_id = uniqid('int_', false);
      $generated_id = substr($generated_id, 0, 30);
      $gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
    }
    $message = array(
      'sender' => $sendername,
      'messagetext' => $messagetext,
      'flash' => "{$flash}",
    );

    $request = array('SMS' => array(
          'auth' => array(
              'username' => $username,
              'apikey' => $apikey
          ),
          'message' => $message,
          'recipients' => $gsm
    ));
    $json_data = json_encode($request);
    if ($json_data) {
      $response = self::doPostRequest($url, $json_data, array('Content-Type: application/json'));
      $result = json_decode($response);
      return $result->response->status;
    } else {
      return false;
    }
    }


    public static function useXML($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
    $country_code = '234';
    $arr_recipient = explode(',', $recipients);
    $count = count($arr_recipient);
    $msg_ids = array();
    $recipients = '';
 
    $xml = new SimpleXMLElement('<SMS></SMS>');
    $auth = $xml->addChild('auth');
    $auth->addChild('username', $username);
    $auth->addChild('apikey', $apikey);
 
    $msg = $xml->addChild('message');
    $msg->addChild('sender', $sendername);
    $msg->addChild('messagetext', $messagetext);
    $msg->addChild('flash', $flash);
 
    $rcpt = $xml->addChild('recipients');
    for ($i = 0; $i < $count; $i++) {
        $generated_id = uniqid('int_', false);
        $generated_id = substr($generated_id, 0, 30);
        $mobilenumber = trim($arr_recipient[$i]);
        if (substr($mobilenumber, 0, 1) == '0') {
            $mobilenumber = $country_code . substr($mobilenumber, 1);
        } elseif (substr($mobilenumber, 0, 1) == '+') {
            $mobilenumber = substr($mobilenumber, 1);
        }
        $gsm = $rcpt->addChild('gsm');
        $gsm->addchild('msidn', $mobilenumber);
        $gsm->addchild('msgid', $generated_id);
    }
    $xmlrequest = $xml->asXML();
 
    if ($xmlrequest) {
        $result =self::doPostRequest($url, $xmlrequest, array('Content-Type: application/xml'));
        $xmlresponse = new SimpleXMLElement($result);
        return $xmlresponse->status;
    }
    return false;
}

    //Function to connect to SMS sending server using HTTP POST

    public static function doPostRequest($url, $data, $headers = array('Content-Type: application/x-www-form-urlencoded'))
    {
    $php_errormsg = '';
    if (is_array($data)) {
      $data = http_build_query($data, '', '&');
    }
    $params = array('http' => array(
          'method' => 'POST',
          'content' => $data)
    );
    if ($headers !== null) {
      $params['http']['header'] = $headers;
    }
    $ctx = stream_context_create($params);
    $fp = fopen($url, 'rb', false, $ctx);
    if (!$fp) {
      return "Error: gateway is inaccessible";
    }
    //stream_set_timeout($fp, 0, 250);
    try {
      $response = stream_get_contents($fp);
      if ($response === false) {
          throw new Exception("Problem reading data from $url, $php_errormsg");
      }
      return $response;
    } catch (Exception $e) {
      $response = $e->getMessage();
      return $response;
    }
    }

	


}