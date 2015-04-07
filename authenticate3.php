<?php
session_start();
if(!isset($_POST['number']) && !isset($_SESSION['id']))
{
	header('Location: index.php');
}
$if($_SESSION['authenticate']!="true")
{
	header('Location: index.php');
}
$if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
$id = $_SESSION['id'];
$number = $_POST['number'];
$url = 'https://api.nexmo.com/verify/check/json?' . http_build_query([
        'api_key' => '********',
        'api_secret' => '**********',
        'request_id' => $id,
        'code' => $number
    ]);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$number = $_SESSSION['phone'];
$arr = json_decode($response,true);
if($arr["status"]=='0')
{
	$url = 'https://rest.nexmo.com/ni/json?' . http_build_query([
        'api_key' => '**********',
        'api_secret' => '************',
        'number' => $number,
        'callback' => 'http://www.jollyverse.com/authenticate-api/insight.php'
    ]);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	$arr = json_decode($response,true);
	if($arr["status"]=='1')
	header('Location: account.php');
}
else
echo $arr["status"];
?>