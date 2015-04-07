<?php
include_once('config.php');
session_start();
if(!isset($_POST['email']) && !isset($_POST['password']))
{
	$msg = "No email Password";
	header('Location: index.php');
}
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('../userAuth.php');
try {
  $mySforceConnection = new SforceEnterpriseClient();
  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
  $_SESSION['authenticate'] = "true";
  $_SESSION['email'] = $USERNAME;
  header('Location: account.php');
} catch (Exception $e) {
  echo $mySforceConnection->getLastRequest();
  $msg = $e->faultstring;
  header('Location: index.php?message=$msg');
}
?>