<?php
if(!isset($_POST['email']) && !isset($_POST['password']))
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
$number = $_POST['number'];
$_SESSION['phone'] = $number;
$url = 'https://api.nexmo.com/verify/json?' . http_build_query([
        'api_key' => '0e9b4868',
        'api_secret' => '5c0700b7',
        'number' => $number,
        'brand' => 'TEST'
    ]);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$arr = json_decode($response,true);
$_SESSION['id']=$arr[request_id];
header('Location: authenticate2.php');
?>