<?php
	if(isset($_SESSION['class_id'])){
		// loading homeworks for class id
	   
	    $classid = $_SESSION['class_id'];
		$homeworks = array();
		
		try
		{
			$sql = "SELECT Id AS HomeworkId, Text FROM Homework WHERE ClassId = '$classid' AND DeleteDate IS NULL AND ExpirationDate >= CURDATE()";
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
	   header("location:login.php");
   }
?>