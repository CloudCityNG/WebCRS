<?php
	include('session.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="../css/home.css"/>
	</head>

	<body>
		<div id="wrapper">
			<div id="header">	
				<div id="logo">
					<img src="../assets/crs logo.png" alt="CRS Logo"/>
				</div>
				<h4>Your one-step solution to manage Course Registrations and view Student Enrollment</h4>
			</div>
			<div id="aside">
				<div id="info">
					<p>Welcome to the Home Page of WebCRS. This page will guide you to your relevant page 
					based on your account type specified in the WebCRS database.</p>
				</div> 
			</div>
			
			<div id = "section">
				Welcome <?php echo $login_session; ?>!<br/><br/>
				You have been identified as<?php
					if($login_type == 1){
						echo " an instructor.";
						$url = "instructor";
					}
					else{
						echo " a student.";
						$url = "registration";
					}
					echo "<br/><br/><a href='$url.php'><img src='../assets/$url.png' alt='$url'/></a>";
				?>
				<br/><br/>
				<a href="logout.php"><img src="../assets/logout.png" alt="Logout"/></a>
			</div>
			<div id="footer">
				<p>&copy;Dixit Bhatta, Anush Shrestha 2015. Powered By:<img src="../assets/uclid.png" alt="uclid"/></p>
			</div>
		</div>	
	</body>
</html>	
