<?php
	function exists($value,$person)
    {
        $xml=simplexml_load_file("../data/$person.xml") 
					or die("Error: File does not exist");
				foreach($xml->children() as $course) {
					if($value==$course){
						return true;
					}
				}
        return false;
    }
	if(isset($_POST['check_course'])){
		$user = $_SESSION['login_user'];
		foreach($_POST['check_course'] as $value)
		{
			//getting the student who is registering for the course
			$quePerson = "SELECT person.personId
					FROM login
					INNER JOIN person
					ON login.username = person.username
					WHERE person.username='$user';";
			$resPerson = mysqli_query($cxn,$quePerson);
			$rowPerson = mysqli_fetch_assoc($resPerson);
			extract($rowPerson);
			$person = $personId;
			$key = $person.$value;
			
			//get enrollment and prerequisite from database
			$queCourse = "SELECT course.maxClassSize, course.preReq, course.enrollment
						FROM course
						WHERE course.courseId ='$value';";
			$resCourse = mysqli_query($cxn,$queCourse);
			$rowCourse = mysqli_fetch_assoc($resCourse);
			extract($rowCourse);
			$size =$maxClassSize;
			$req =$preReq;
			$enroll = $enrollment;
			
			//check enrollment and prerequisite before registration
			if($size>$enroll){
				//prerequisite checking code
				//reads XML file and checks for passed courses
				$xml=simplexml_load_file("../data/$person.xml") 
					or die("Error: File does not exist");
				if(!exists($value,$person)){//TODO check if a value exists in a foreach object
					if($req =='None' || exists($req,$person)){
						$enroll = $enroll + 1;
						$query = "INSERT INTO registration(registrationId,studentId,courseId) VALUES ('$key','$person','$value')";
						$result = mysqli_query($cxn,$query)
							or die (mysqli_error($cxn));
						$query = "UPDATE course SET enrollment = $enroll WHERE courseId = '$value';";
						$result = mysqli_query($cxn,$query)
							or die (mysqli_error($cxn));
						$message = "Registration Successful for $value!";
					}
					else{
					$message = "Prerequisite not fulfilled for $value!";
				}
				}
				else{
					$message ="Course $value already passed!";
				}
				
			}
			else{
				$message = "Enrollment for $value is full!";
			}
		}
	}
?>
