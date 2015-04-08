<?php
include_once('config.php');
session_start();
if(!isset($_POST['email']) && !isset($_POST['password']))
{
	$msg = "No email Password";
	header('Location: index.php');
}
$USERNAME = $_POST['email'];
$PASSWORD = $_POST['password']."DuJ8jsRWCzVDoByuNBefojSN";
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
try {
  $mySforceConnection = new SforceEnterpriseClient();
  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl');
  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
  $_SESSION['authenticate'] = "true";
  $_SESSION['email'] = $USERNAME;
  header('Location: account.php');
} catch (Exception $e) {
  echo $mySforceConnection->getLastRequest();
  echo $msg = $e->faultstring;
  header('Location: index.php?message=$msg');
}
?>