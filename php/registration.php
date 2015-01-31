<?php
	include('session.php');
	if(isset($_POST['button_register'])){
		include('register.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="../css/reg.css"/>
		<link rel="stylesheet" type="text/css" href="../css/headers.css"/>
		<link rel="stylesheet" type="text/css" href="../css/popup.css"/>
		<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
		<script type="text/javascript" src="../js/main.js"></script>
	</head>

	<body>
		<div id="header">	
			<div id="logo">
				<img src="../assets/crs logo.png" alt="CRS Logo"/>
			</div>
			<h5>Your one-step solution to manage Course Registrations and view Student Enrollment</h5>
			<ul class="myMenu">
				<li><a href="#"><?php echo $login_session; ?></a>
					<ul>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</li>
				<li><a href="courses.php">Courses</a></li>
				<li><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Support</a></li>
			</ul>
		</div>
		<div id="light" class="white_content">
			All pages are self-descriptive.<br/><br/>
			For further support contact us at:<br/><br/>
			silentflutes@gmail.com<br/>
			ucliddixit@gmail.com<br/><br/>
			<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>
		</div>
		<div id="fade" class="black_overlay"></div>
		<form id="form" name="register_form" method="post" action="registration.php">
			<div id="aside">
				<div id="info">
					<p>Welcome to the Registration Page. Pick from the available courses
					by checking alongside "Pick this course" and click "Register".</p>
				</div>
				<div id="filter_course">
					<table>
						<tr>
							<th>FILTER COURSE</th>
							<th><input class="filter" type="submit" value="Filter" name="filter"/></th>
						</tr>
						<tr>
							<td>Core</td>
							<td><input name="type[]" type="checkbox" value="CORE" /></td>
						</tr>
						<tr>
							<td>General</td>
							<td><input name="type[]" type="checkbox" value="GENERAL" /></td>
						</tr>
						<tr>
							<td>Elective</td>
							<td><input name="type[]" type="checkbox" value="ELECTIVE" /></td>
						</tr>
					</table>
				</div>
			 
				<div id="filter_year">
					<table>
						<tr>
							<th>FILTER YEAR</th>
							 <th><input class="filter" type="submit" value="Filter" name="filter"/></th>
						</tr>
						<tr>
							<td>First</td><td><input name="year[]" type="checkbox" value="1"/></td>
						</tr>
						<tr>
							<td>Second</td><td><input name="year[]" type="checkbox" value="2"/></td>
						</tr>
						<tr>
							<td>Third</td><td><input name="year[]" type="checkbox" value="3"/></td>
						</tr>
						<tr>
							<td>Fourth</td><td><input name="year[]" type="checkbox" value="4"/></td>
						</tr>
					</table>
				</div> 
			</div>
			
			<div id="section">
				<?php
					if(isset($message)){
						echo "<p>$message</p>";
					}
					if(isset($_SESSION['login_user'])){
						if(!isset($_POST['filter'])){
							$queCourse = "SELECT course.courseType, course.courseId, 
												course.courseName, course.courseDescrp, 
												course.credits, course.availability
										FROM course;";
							$resCourse = mysqli_query($cxn,$queCourse);
							$nrows = mysqli_num_rows($resCourse);
							
							for ($i=0;$i<$nrows;$i++)
							{
								$rowCour = mysqli_fetch_assoc($resCourse);
								extract($rowCour);
								if($availability != 0){
									echo "<div class='courseinfo'>
											<div class='course_pic'><p>$courseType<br/>COURSE</p></div>	
											<div class='single_courseinfo'>
												<div class='single_courseinfocollector'>
												<p class='ccode'>$courseId : $courseName</p><br/>
												<p>$courseDescrp</p><br/>
												<p>Credits: $credits Credits</p><br/>
												<p class='radio'>Enroll:<input  type='radio' name='check_course[]' value='$courseId'/><p> 	
												</div>
											</div>		
										</div>";
								}
							}
						}
					}
					include('filter.php');
				?>	
			</div>
			<p><input id="register" type="submit" value="Register" name="button_register"/></p>
		</form>
		<div id="footer">
			<p>&copy;Dixit Bhatta, Anush Shrestha 2015. Powered By:<img src="../assets/uclid.png" alt="uclid"/></p>
		</div>
	</body>
</html>
