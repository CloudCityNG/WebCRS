<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['signin'])) {
		$host= "localhost";
		$user= "root";
		$password= "";
		$dbname = "webcrs";
		$cxn = mysqli_connect($host,$user,$password,$dbname)
			or die ("Couldn't connect to server.");
		$pword = $_POST['pword']; // password user entered in form
		$uname = $_POST['uname'];// username user entered in form
		$query = "SELECT password,userType FROM login WHERE username='".$uname."'";
		$result = mysqli_query($cxn,$query)
			or die ("Couldn’t execute query.");
		$row = mysqli_fetch_assoc($result);
		if ( $pword == $row['password'] )
		{
			$_SESSION['login_user']=$uname; // Initializing Session
			header('Location: php/home.php');
		}
		else
		{
			$error="Invalid password!";
		}
		mysqli_close($cxn); // Closing Connection
	}
?>
