<?php
	if(isset($_SESSION['class_id'])){
		// loading announcements for class id
	   
	    $classid = $_SESSION['class_id'];
		$announcements = array();
		
		try
		{
			$sql = "SELECT Id AS AnnouncementId, Text FROM Announcement WHERE ClassId = '$classid' AND DeleteDate IS NULL AND ExpirationDate >= CURDATE()";
			$announcementsResult = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($announcementsResult,MYSQLI_ASSOC))
			{
				$announcements[] = $row;
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