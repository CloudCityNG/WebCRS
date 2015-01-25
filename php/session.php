<?php
	$host= "localhost";
	$user= "root";
	$password= "";
	$dbname = "webcrs";
	$cxn = mysqli_connect($host,$user,$password,$dbname)
		or die ("Couldn't connect to server.");
	session_start();// Starting Session
	// Storing Session
	$user_check=$_SESSION['login_user'];
	// SQL Query To Fetch Complete Information Of User
	$query = "SELECT username,userType FROM login WHERE username='".$user_check."'";
	$result = mysqli_query($cxn,$query)
		or die ("Couldn’t execute query.");
	$row = mysqli_fetch_assoc($result);
	$login_session =$row['username'];
	$login_type= $row['userType'];
	if(!isset($login_session)){
		mysqli_close($cxn); // Closing Connection
		header('Location: ../index.php'); // Redirecting To Home Page
	}
?>
