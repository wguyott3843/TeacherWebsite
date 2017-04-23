<?php
	if(isset($_SESSION['class_id'])){
		// loading homework for class id
	   
		$classId = $_SESSION['class_id'];
		$homeworks = array();
			
		try
		{
			$sql = "SELECT Id AS HomeworkId, Text, ExpirationDate FROM Homework WHERE ClassId = '$classId' AND DeleteDate IS NULL ORDER BY ExpirationDate ASC";
			$homeworksResult = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($homeworksResult,MYSQLI_ASSOC))
			{
				$homeworks[] = $row;
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