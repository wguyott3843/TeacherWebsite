<?php
	if(isset($_SESSION['teacher_id'])){
		// loading students for teacher id
	   
	    $teacherId = $_SESSION['teacher_id'];
		$students = array();
		
		try
		{
			$sql = "SELECT s.Id AS StudentId, s.GradeLevel, p.Email, p.FirstName, p.LastName, p.Login FROM Student s INNER JOIN Person p ON s.PersonId = p.Id WHERE s.HomeroomTeacherId = '$teacherId' AND p.DeleteDate IS NULL ORDER BY p.LastName ASC;";
			$studentsResult = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($studentsResult,MYSQLI_ASSOC))
			{
				$students[] = $row;
			}
		}catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
	}
   
	else{
	  header("location:logout.php");
	}
?>