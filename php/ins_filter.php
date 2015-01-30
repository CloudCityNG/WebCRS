<?php
	function IsChecked($chkname,$value){
        if(!empty($_POST[$chkname])){
            foreach($_POST[$chkname] as $chkval){
                if($chkval == $value){
                    return true;
                }
            }
        }
        return false;
    }
	if (isset($_POST['filter'])) {
		if(isset($_POST['years']) || isset($_POST['sel_course'])){
			$years = isset($_POST['years'])?$_POST['years']:'0';
			$years[0] = (IsChecked('years','1'))?1:'0';
			$years[1] = (IsChecked('years','2'))?2:'0';
			$years[2] = (IsChecked('years','3'))?3:'0';
			$years[3] = (IsChecked('years','4'))?4:'0';
			$selectOption = isset($_POST['sel_course'])?$_POST['sel_course']:'0';
			$flag=0;
			$counter = 0;
			
			//getting current instructorId
			$quePerson = "SELECT person.personId
					FROM login
					INNER JOIN person
					ON login.username = person.username
					WHERE person.username='$user';";
			$resPerson = mysqli_query($cxn,$quePerson);
			$rowPerson = mysqli_fetch_assoc($resPerson);
			extract($rowPerson);
			$person = $personId;
			
			//getting course details
			$queCourse = "SELECT course.courseId 
						FROM course
						INNER JOIN person
						ON course.instructorId = person.personId
						WHERE course.instructorId = '$person';";
			$resCourse = mysqli_query($cxn,$queCourse);
			$nrows = mysqli_num_rows($resCourse);
			
			for ($i=0;$i<$nrows;$i++)
			{
				$rowCour = mysqli_fetch_assoc($resCourse);
				extract($rowCour);
				$course = $courseId;
				
				//getting student details
				$queStu = "SELECT registration.courseId, person.fullName, person.year
						FROM registration
						INNER JOIN person
						ON registration.studentId = person.personId
						WHERE registration.courseId = '$course';";
				
				$resStu = mysqli_query($cxn,$queStu);
				$numrows = mysqli_num_rows($resStu);
				
				for ($j=0;$j<$numrows;$j++)
				{
					$rowStu = mysqli_fetch_assoc($resStu);
					extract($rowStu);
					//now display
					if($course==$selectOption ||
						$year==$years[0] || $year==$years[1] || $year==$years[2] || $year==$years[3]){
						echo "<tr>
								<td>$fullName</td>  
								<td>&nbsp;&nbsp;$year</td>
								<td>$course</td>
							</tr>
						";
						$counter = $counter+1;
						$flag = 1;
					}
				}
			}
			if($flag==0){
					echo "No results found!";
			}
		}
	}
?>
