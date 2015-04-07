<?php
session_start();
$if(!isset($_SESSION['email']))
{
	header('Location: index.php');
}
include_once('config.php');
		if($_SERVER['REQUEST_METHOD'] == "POST"){
		$id = $_POST['request_id'];
		$number = $_POST['number'];
		$user = $_SESSION['email'];
		$device = $_POST['number_type'];
		$country = $_POST['carrier_country_code'];
		$career = $_POST['career_network_name'];
		$reach = $_POST['reachable'];
		$last = date('Y/m/d');
		
		$query = "INSERT INTO salesforce VALUES ($id,'$number', '$user','$last','$device','$career', '$country', '$reach')";
		$insert = mysqli_query($query,$conn);
		if($insert){
		$data = array('result' => 1, 'message' => 'Successfully user added!');
		} else {
		$data = array('result' => 0, 'message' => 'Error!');
		}
		 else {
		$data = array('result' => 0, 'message' => 'Request method is wrong!');
		}
}
?>