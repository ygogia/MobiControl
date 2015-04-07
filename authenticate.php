<?php
session_start();
if(!isset($_POST['number']))
{
	header('Location: account.php');
}
$if($_SESSION['authenticate']!="true")
{
	header('Location: index.php');
}
$if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
$number = $_POST['number'];
$url = 'https://api.nexmo.com/verify/json?' . http_build_query([
        'api_key' => '*********',
        'api_secret' => '*********',
        'number' => $number,
        'brand' => 'TEST'
    ]);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$arr = json_decode($response,true);
$_SESSION['id']=$arr["request_id"];
$_SESSION['phone']=$number;
header('Location: authenticate2.php');
?>