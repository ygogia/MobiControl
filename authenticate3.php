<?php
session_start();
if(!isset($_POST['number']) && !isset($_SESSION['id']))
{
	header('Location: index.php');
}
if($_SESSION['authenticate']!="true")
{
	header('Location: index.php');
}
if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
$id = $_SESSION['id'];
$number = $_POST['number'];

$data = array('api_key' => '0e9b4868','api_secret' => '5c0700b7','request_id' => $id, 'code' => $number );  
$data_string = json_encode($data);     
$url = 'https://api.nexmo.com/verify/check/json?';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);     
$response = curl_exec($ch);

$number = $_SESSSION['phone'];
$arr = json_decode($response,true);
if($arr["status"]=='0')
{
	$url = 'https://rest.nexmo.com/ni/json?' ;
	$data = array('api_key' => '0e9b4868','api_secret' => '5c0700b7', 'number' => $number, 'callback' => 'http://www.jollyverse.com/authenticate-api/insight.php' );       
	$data_string = json_encode($data); 
	$ch = curl_init($url);
	
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	    'Content-Type: application/json',                                                                                
	    'Content-Length: ' . strlen($data_string))                                                                       
	);     
	$response = curl_exec($ch);
	
	$arr = json_decode($response,true);
	echo $arr;
	if($arr["status"]=='1')
	header('Location: account.php');
}
else
echo $arr["status"];
?>