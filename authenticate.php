<?php
session_start();
if($_SESSION['authenticate']!="true")
	header('Location: index.php');
if(!isset($_SESSION['email']))
	header('Location: index.php');
	
$number = $_POST['number'];
$data = array('api_key' => '0e9b4868','api_secret' => '5c0700b7','number' => $number,'brand' => 'TEST' );                                                                    
$data_string = json_encode($data);                                                                                   
$ch = curl_init('https://api.nexmo.com/verify/json?');                                                                      
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json',                                                                                
    'Content-Length: ' . strlen($data_string))                                                                       
);                                               
$result = curl_exec($ch);
$arr = json_decode($result,true);
$_SESSION['id']=$arr["request_id"];
$_SESSION['phone']=$number;
header('Location: authenticate2.php');
?>