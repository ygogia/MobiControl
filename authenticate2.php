<?php
session_start();
if(!isset($_SESSION['id']))
{
	header('Location: account.php');
}
?>
<html>
<head>
<title>Salesforce Mobile Control Setup </title>
<head>
<body>
<header>
<hr>
<center><h1 id='top'>Welcome, Add New Mobile Control Device<b></center>
<header>
<hr>
<form method='POST' action='authenticate3.php'>
	<label>Code Recieved:</label>&nbsp;
	<input type='number' id='number' name='number'><br><br>
	<input type='submit' value='Submit'>
</form>
<hr>