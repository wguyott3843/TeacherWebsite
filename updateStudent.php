<?php
   include('database php/session.php');
   
   if($_SESSION['person_lastname'] == ""){
	   $error = "You must specify a last name.";
   }
   elseif($_SESSION['person_firstname'] == ""){
	   $error = "You must specify a first name.";
   }
   elseif($_SESSION['person_email'] == ""){
	   $error = "You must specify an email address.";
   }
   elseif($_SESSION['person_login'] == ""){
	   $error = "You must specify a login.";
   }
   elseif($_SESSION['student_gradelevel'] == ""){
	   $error = "You must specify a grade level.";
   }
   else{
		if($_SESSION[person_password] == ""){
			$noPassword = true;  
		}
		else{
			$noPassword = false;
		}
		
		// Doing this to prevent sql hacking.
		$lastName = mysqli_real_escape_string($db,$_SESSION['person_lastname']);
		$firstName = mysqli_real_escape_string($db,$_SESSION['person_firstname']);
		$email = mysqli_real_escape_string($db,$_SESSION['person_email']);
		$login = mysqli_real_escape_string($db,$_SESSION['person_login']);
		$gradeLevel = mysqli_real_escape_string($db,$_SESSION['student_gradelevel']);
	
		if($noPassword == false){
			$password = mysqli_real_escape_string($db,$_SESSION['person_password']);
		}
		
		$teacherId = $_SESSION['teacher_id'];
		$studentId = $_SESSION['student_id'];
		
		try
		{
			$sql = "SELECT PersonId FROM Student WHERE Id = '$studentId'";
			$personsResult = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($personsResult,MYSQLI_ASSOC);
			$personId = $row['PersonId'];
			
			if($noPassword){
				$sql = "UPDATE Person SET FirstName = '$firstName', LastName = '$lastName', Email = '$email', Login = '$login' WHERE Id = '$personId'";
			}
			else{
				$sql = "UPDATE Person SET FirstName = '$firstName', LastName = '$lastName', Email = '$email', Login = '$login', Password = '$password' WHERE Id = '$personId'";
			}

			mysqli_query($db,$sql);
			
			// Adding the new class to the TeacherClassMap table.
			$sql = "UPDATE Student SET GradeLevel = '$gradeLevel' WHERE Id = '$studentId'";
			mysqli_query($db,$sql);
			
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
	
    <title>Add Class</title>
	
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