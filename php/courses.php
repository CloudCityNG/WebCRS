<?php
	include('session.php');
	include('popCourse.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Courses</title>
		<link rel="stylesheet" type="text/css" href="../css/course.css"/>
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
		<div id="section">
			<?php
				if(isset($_SESSION['login_user'])){
					$queCourse = "SELECT course.courseType, course.courseId, 
										course.courseName, course.courseDescrp, 
										course.credits, person.fullName
								FROM course
								INNER JOIN person
								ON course.instructorId = person.personId;";
					$resCourse = mysqli_query($cxn,$queCourse);
					$nrows = mysqli_num_rows($resCourse);
					
					for ($i=0;$i<$nrows;$i++)
					{
						$rowCour = mysqli_fetch_assoc($resCourse);
						extract($rowCour);
						echo "<div class='courseinfo'>
								<div class='course_pic'><p>$courseType <br/>COURSE</p></div>	
								<div class='single_courseinfo'>
									<p class='ccode'>$courseId</p><br/>
									<p class='cname'>$courseName</p><br/>
									<p>$courseDescrp</p><br/>
									<p>Credits: $credits Credits</p><br/>
									<p>Instructor: $fullName</p>    	
								</div>		
							</div>";
					}
				}	
			?>
			</div>
		</div>
		
		<div id="info">
				<p>Welcome to the Courses Page. You can find all offered courses of the whole course of study here. Even
				the courses which are not available for registration are here. You can use this page for searching the 
				courses by code or name, and plan for your future registrations.</p>
		</div>
		<div id="aside">
			<input id="search" type="text" name="search" placeholder="search..." autofocus="autofocus"/>
			<input id="search_button" type="button" value="Search"/>
		</div>
		<div id="footer">
			<p>&copy;Dixit Bhatta, Anush Shrestha 2015. Powered By:<img src="../assets/uclid.png" alt="uclid"/></p>
		</div>
	</body>
</html>
