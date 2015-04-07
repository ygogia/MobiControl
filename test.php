<?php
include_once('config.php');
//MessageBird Virtual Number Inbound Message Callback Script - RESTful
header("HTTP/1.1 200 OK");
		if(1){
		$id = $_POST['id'];
		$rec = $_POST['recipient'];
		$ori = $_POST['originator'];
		$date = $_POST['createdDatetime'];
		$body = $_POST['createdDatetime'];
		echo $id.$rec.$ori.$date.$body;
//SALESFORCE API INTEGRATION
		define("SOAP_CLIENT_BASEDIR", "http://www.jollyverse.com/php/soapclient"); // SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
		require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
//SALESFORCE NEW CONNECTION
		try {
		  $mySforceConnection = new SforceEnterpriseClient();
		  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
		  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD); //ENTER USERNAME PASSWORD HERE
		  echo "***** Login Info*****\n";
		  print_r($mylogin);
		  }
		  catch (Exception $e) {
		  print_r($mySforceConnection->getLastRequest());
		  echo $e->faultstring;
		}

		header('Content-type: application/json');
		echo json_encode($data);
		}
		else
		{
		echo "Bad Request";
		}
?>