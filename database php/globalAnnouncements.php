<?php
	// loading global announcements
		   
	$announcements = array();
			
	try
	{
		$sql = "SELECT Id AS AnnouncementId, Text FROM Announcement WHERE ClassId IS NULL AND DeleteDate IS NULL AND ExpirationDate >= CURDATE()";
		$announcementsResult = mysqli_query($db,$sql);
		while($row = mysqli_fetch_array($announcementsResult,MYSQLI_ASSOC))
		{
			$announcements[] = $row;
		}
	}catch(Exception $e)
	{
		die("Database Error: " . $e->getMessage());
	}
?>