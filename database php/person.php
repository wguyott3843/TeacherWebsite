<?php
	if(isset($_SESSION['person_id'])){
		// loading homeworks for class id
	   
	    $personid = $_SESSION['person_id'];
		$person = array();
		
		try
		{		
			$sql = "SELECT FirstName, LastName, Email, Login, Password, CreateDate FROM Person WHERE Id = $personid AND DeleteDate IS NULL";
			$personResult = mysqli_query($db,$sql);
			$person = mysqli_fetch_array($personResult,MYSQLI_ASSOC);
		}
		catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
   }
   else{
	   header("location:login.php");
   }
?>