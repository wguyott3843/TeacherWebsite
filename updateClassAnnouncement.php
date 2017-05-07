<?php
   include('database php/session.php');
   
   if($_SESSION['announcement_description'] == ""){
	   $error = "you must specify a description for the announcement.";
   }
   elseif($_SESSION['announcement_text'] == ""){
	   $error = "you must specify announcement text.";
   }
   else{
		// Doing this to prevent sql hacking.
		$announcementDescription = mysqli_real_escape_string($db,$_SESSION['announcement_description']);
		$announcementText = mysqli_real_escape_string($db,$_SESSION['announcement_text']);
		$classId = $_SESSION['announcement_id'];
		
		try
		{
			$sql = "UPDATE Announcement SET Description = '$announcementDescription', Text = '$announcementText'";
			mysqli_query($db,$sql);
			
			header("location: manageGlobalAnnouncement.php");
		}
		catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
		
		header("location: manageGlobalAnnouncement.php");
   }
?>

<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name = "description" content = "Teacher Website Login Page">
    <meta name = "author" content = "William Guyott">
	<link rel = "icon" href = "images/Apple.ico">
	
    <title>Update Global Announcement</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<h1>Error: <?php echo $error ?></h1>
		<a class = "btn" href = "manageClass.php" type = "button">continue</a>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>