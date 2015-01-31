<!--Main HTML file for the project, others can be added later-->
<!--This is the login page generated for the CRS-->
<?php
	include('php/main.php'); // Includes Main Login Script
	if(isset($_SESSION['login_user'])){
		header('Location: php/home.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Welcome to WebCRS</title>
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
  </head>
  <body>
	<div id="wrapper">
		<div id="intro">
			<h1>Welcome to WebCRS!</h1>
			<h2>Your one-step solution to manage Course Registrations and view Student Enrollment</h2>
			<p id="info">WebCRS allows you to manage your registration process using a simple interface and enables instructors to view their 
			course enrollments</p>
		</div>
		<div id="main">
		  <div id = "logo">
			<p><img src="assets/crs logo big.png" alt="CRS Logo"/></p>
		  </div>
		  <div id="inputs">
			<form name="login" method="post" action="index.php">
				<p><input type="text" name="uname" id="uname" class="textbox" autofocus="autofocus" required="required" placeholder="username"/></p>
				<p><input type="password" id="pword" name="pword" class="textbox" required="required" placeholder="password"/></p>
				<p><input type="submit" name="signin" id="signin" value="Sign In"/></p>
				<span><?php echo $error; ?></span>
			</form>
		  </div>
		</div>	
	</div>
  </body>
</html>
