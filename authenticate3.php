<?php
if(!isset($_POST['email']) && !isset($_POST['password'])&& !isset($_POST['number']) && !isset($_SESSION['id']))
{
	header('Location: index.php?message=$msg');
}
$if($_SESSION['authenticate']!="true")
{
	header('Location: index.php');
}
$if(!isset($_POST['email']))
{
	header('Location: account.php');
}
$id = $_SESSION['id'] ;
$number = $_POST['number'];
$url = 'https://api.nexmo.com/verify/check/json?' . http_build_query([
        'api_key' => '0e9b4868',
        'api_secret' => '5c0700b7',
        'request_id' => $id,
        'code' => $number
    ]);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$number = $_SESSSION['phone'];
$arr = json_decode($response,true);
if($arr[status]=='0')
{
	$url = 'https://rest.nexmo.com/ni/json?' . http_build_query([
        'api_key' => '0e9b4868',
        'api_secret' => '5c0700b7',
        'number' => $number,
        'callback' => 'http://www.jollyverse.com/authenticate-api/insight.php'
    ]);
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	header('Location: authenticate2.php?success=true');
}
else
echo $arr[status];
?>