<?php
include_once('config.php');
//MessageBird Virtual Number Inbound Message Callback Script - RESTful
header("HTTP/1.1 200 OK");
		if($_SERVER['REQUEST_METHOD'] == "POST"){
		$id = $_POST['id'];
		$rec = $_POST['recipient'];
		$ori = $_POST['originator'];
		$date = $_POST['createdDatetime'];
		$body = $_POST['createdDatetime'];
//SALESFORCE API INTEGRATION
		define("SOAP_CLIENT_BASEDIR", "http://www.jollyverse.com/php/soapclient"); // SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
		require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
//SALESFORCE NEW CONNECTION
		try {
		  $mySforceConnection = new SforceEnterpriseClient();
		  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
		  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD); //ENTER USERNAME PASSWORD HERE
		  $command[0] = explode(" ",$body);
		  if($command[0]=="CONVERT"){
			 $leadConvert = new stdClass;
			  $leadConvert->convertedStatus=$command[2];
			  $leadConvert->doNotCreateOpportunity='false';
			  $leadConvert->leadId=$command[1];
			  $leadConvert->overwriteLeadSource='true';
			  $leadConvert->sendNotificationEmail='true';

			  $leadConvertArray = array($leadConvert);
			  $leadConvertResponse = $mySforceConnection->convertLead($leadConvertArray);
			  $data = array('result' => 1);
			}
			else if($command=="")
			{
				//ADD MORE FUNCTIONALITIES HERE
			}
		  }		  
		  catch (Exception $e) {
		  
		}

		header('Content-type: application/json');
		echo json_encode($data);
		}
		else
		{
			echo "Bad Request";
		}
?>