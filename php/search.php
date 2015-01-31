<?php
	if (isset($_POST['search_button'])) {
		$queCourse = "SELECT course.courseType, course.courseId, 
							course.courseName, course.courseDescrp, 
							course.credits, person.fullName
					FROM course
					INNER JOIN person
					ON course.instructorId = person.personId;";
		$resCourse = mysqli_query($cxn,$queCourse);
		$nrows = mysqli_num_rows($resCourse);
		$searchterm = $_POST['search'];
		$flag=0;
			for ($i=0;$i<$nrows;$i++)
			{
				$rowCour = mysqli_fetch_assoc($resCourse);
				extract($rowCour);
				if (strpos(strtolower($courseName),$searchterm) !== false) {
					echo "<div class='courseinfo'>
							<div class='course_pic'><p>$courseType <br/>COURSE</p></div>	
							<div class='single_courseinfo'>
								<p class='ccode'>$courseId</p><br/>
								<p class='cname'>$courseName</p><br/>
								<p>$courseDescrp</p><br/>
								<p>Credits: $credits Credits &nbsp;&nbsp;Instructor: $fullName</p>  	
							</div>		
						</div>";
					$flag=1;
				}
			}
		if($flag==0){
				echo "No results found!";
		}
	}
?>
