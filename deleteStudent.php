<?php
   include('database php/session.php');
   
   if($_SESSION['person_firstname'] == ""){
	   $error = "You must specify a first name.";
   }
   elseif($_SESSION['person_lastname'] == ""){
	   $error = "You must specify a last name.";
   }
   else{
		$studentId = $_SESSION['student_id'];
		
		try
		{
			$sql = "SELECT PersonId FROM Student WHERE Id = '$studentId'";
			$personsResult = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($personsResult,MYSQLI_ASSOC);
			$personId = $row['PersonId'];
			
			$sql = "UPDATE Person SET DeleteDate = CURDATE() WHERE Id = '$personId'";
			mysqli_query($db,$sql);
			
			unset($_SESSION['student_id']);
			
			header("location: manageStudent.php");
		}
		catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
		
		header("location: manageStudent.php");
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
	
    <title>Delete Class</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<h1>Error: <?php echo $error ?></h1>
		<a class = "btn" href = "manageStudent.php" type = "button">continue</a>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>