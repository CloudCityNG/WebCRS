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
		if(isset($_POST['type']) || isset($_POST['year'])){
			$queCourse = "SELECT course.courseType, course.courseId, course.semester,
								course.courseName, course.courseDescrp, 
								course.credits, course.availability
						FROM course;";
			$resCourse = mysqli_query($cxn,$queCourse);
			$nrows = mysqli_num_rows($resCourse);
			$type = isset($_POST['type'])?$_POST['type']:'0';
			$type[0] = (IsChecked('type','CORE'))?'CORE':'0';
			$type[1] = (IsChecked('type','GENERAL'))?'GENERAL':'0';
			$type[2] = (IsChecked('type','ELECTIVE'))?'ELECTIVE':'0';
			$year = isset($_POST['year'])?$_POST['year']:'0';
			$year[0] = (IsChecked('year','1'))?1:'0';
			$year[1] = (IsChecked('year','2'))?2:'0';
			$year[2] = (IsChecked('year','3'))?3:'0';
			$year[3] = (IsChecked('year','4'))?4:'0';
			$flag=0;
				for ($i=0;$i<$nrows;$i++){
					$rowCour = mysqli_fetch_assoc($resCourse);
					extract($rowCour);
					if($semester == 1 || $semester ==2){
						$semester = 1;
					}
					else if($semester == 3 || $semester ==4){
						$semester = 2;
					}
					else if($semester == 5 || $semester ==6){
						$semester =3;
					}
					else{
						$semester=4;
					}
					if($availability != 0){
						if($courseType==$type[0] || $courseType==$type[1] || $courseType==$type[2] ||
							$semester==$year[0] || $semester==$year[1] || $semester==$year[2] || $semester==$year[3]){
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
							$flag=1;
						}
					}
				}
			if($flag==0){
					echo "No results found!";
			}
		}
	}
