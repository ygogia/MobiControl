<?php
session_start();
if(isset($_SESSION['email'])&&isset($_SESSION['authenticate']))
{
	if($_SESSION['authenticate']!="true")
	{
		header('Location: index.php');
	}
	$email = $_SESSION['email']
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
<form method='POST' action='authenticate.php'>
	<label>Mobile:</label>&nbsp;
	<input type='number' id='number' name='number'><br><br>
	<input type='submit' value='Submit'>
</form>
<hr>
<h2><center>Last Login Details:</center></h2>
<hr>
<?php
include('config');
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM salesforce LIMIT 20";
$result = mysqli_query($sql,$conn);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<br> Device: " . $row['device']."<br> Number: " . $row['cell'] ." <br> Last Login: " . $row['last_login']. "<br> Career" . $row['career']."<br> Country" . $row['country']."<br> Status" . $row['reach']. "<hr>";
    }
}
else {
    echo "No Last Login,<a href='#top'>Add New Mobile</a>";
}
?>
<h2><center>Authenticated Control Mobiles:</center></h2>
<hr>
<?php
$sql = "SELECT DISTINCT cell FROM salesforce where salesforce_user='$email' ";
$result = mysqli_query($sql,$conn);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        "<br> Number: " . $row['cell'];
    }
}
else {
    echo "No Mobile Control,<a href='#top'>Add New Mobile</a>";
}
?>
</body>
</html>

<?


?>