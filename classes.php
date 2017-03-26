<?php
	if(isset($_SESSION['teacher_id'])){
		// loading classes for teacher id
	   
	    $teacherid = $_SESSION['teacher_id'];
		$classes = array();
		
		try
		{
			$sql = "SELECT Id AS ClassId, Number, Name, Description FROM Class WHERE Id IN (SELECT ClassId FROM TeacherClassMap WHERE TeacherId = '$teacherid' AND DeleteDate IS NULL)";
			$classesResult = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($classesResult,MYSQLI_ASSOC))
			{
				$classes[] = $row;
			}
		}catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
   }
   elseif(isset($_SESSION['student_id'])){
		// loading classes for student id
	   
	    $studentid = $_SESSION['student_id'];
		$classes = array();
		
		try
		{
			$sql = "SELECT Id AS ClassId, Number, Name, Description FROM Class WHERE Id IN (SELECT ClassId FROM StudentClassMap WHERE StudentId = '$studentid' AND DeleteDate IS NULL)";
			$classesResult = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($classesResult,MYSQLI_ASSOC))
			{
				$classes[] = $row;
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