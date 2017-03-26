<?php
   include('session.php');
   
   if($_SESSION['class_number'] == ""){
	   $error = "you must specify a class number";
   }
   elseif($_SESSION['class_name'] == ""){
	   $error = "you must specify a class name.";
   }
   elseif($_SESSION['class_description'] == ""){
	   $error = "you must specify a class description";
   }
   else{
		// Doing this to prevent sql hacking.
		$classNumber = mysqli_real_escape_string($db,$_SESSION['class_number']);
		$className = mysqli_real_escape_string($db,$_SESSION['class_name']);
		$classDescription = mysqli_real_escape_string($db,$_SESSION['class_description']);
		$teacherId = $_SESSION['teacher_id'];
		
		try
		{
			$sql = "INSERT INTO Class (Number, Name, Description, CreateDate, DeleteDate) VALUES ('$classNumber', '$className', '$classDescription', CURDATE(), NULL)";
			mysqli_query($db,$sql);
			
			$sql = "SELECT Id FROM Class WHERE Number = $classNumber AND DeleteDate IS NULL";
			$classesResult = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($classesResult,MYSQLI_ASSOC);
			$classId = $row['Id'];
			$_SESSION['class_id'] = $classId;
			
			// Adding the new class to the TeacherClassMap table.
			$sql = "INSERT INTO TeacherClassMap (TeacherId, ClassId, CreateDate, DeleteDate) VALUES ('$teacherId', '$classId', CURDATE(), NULL)";
			mysqli_query($db,$sql);
			
			header("location: manageClass.php");
		}
		catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
		
		header("location: manageClass.php");
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
	
    <title>Add Class</title>
	
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