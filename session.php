<?php
   include('config.php');
   session_start();
   
   if(isset($_SESSION['teacher_id'])){
	   // validating teacher id
	   
	    $teacherid = $_SESSION['teacher_id'];
		
		$sql = "SELECT Id FROM Teacher WHERE Id = '$teacherid'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		$count = mysqli_num_rows($result);
		
		if($count != 1){
			header("location:login.php");
		}
		else{			
			$sql = "SELECT p.DeleteDate FROM Person p INNER JOIN Teacher t ON t.PersonId = p.Id WHERE t.Id = '$teacherid'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			$deletedate = $row['DeleteDate'];
			if(is_null($deletedate) == false){
				// not an active account
				header("location:login.php");
			}
		}
   }
   elseif(isset($_SESSION['student_id'])){
	    // validating student id
		
	    $studentid = $_SESSION['student_id'];
		
		$sql = "SELECT Id FROM Student WHERE Id = '$studentid'";
		$result = mysqli_query($db,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		
		$count = mysqli_num_rows($result);
		
		if($count != 1){
			header("location:login.php");
		}
		else{			
			$sql = "SELECT p.DeleteDate FROM Person p INNER JOIN Student s ON s.PersonId = p.Id WHERE s.Id = '$studentid'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			$deletedate = $row['DeleteDate'];
			if(is_null($deletedate) == false){
				// not an active account
				header("location:login.php");
			}
		}
   }
   else{
	   header("location:login.php");
   }
?>