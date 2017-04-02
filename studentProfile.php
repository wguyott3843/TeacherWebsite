<?php
   include('database php/session.php');
   include('database php/person.php');
   
   $updateStatus = "";
   
   if($_SERVER["REQUEST_METHOD"] == "POST"){
	   $email = mysqli_real_escape_string($db,$_POST['email']);
	   $password = mysqli_real_escape_string($db,$_POST['password']);
	   $personid = $_SESSION['person_id'];
	   
	   try
		{
			$sql = "UPDATE Person SET Email = '$email', Password = '$password' WHERE Id = $personid";
			mysqli_query($db,$sql);
			
			$_SESSION['update_status'] = "success";
			
			header("location: studentProfile.php");
		}
		catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
		}
	}
	else{
		if(isset($_SESSION['update_status'])){
			$updateStatus = $_SESSION['update_status'];
			unset($_SESSION['update_status']);
		}
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
	
    <title>Profile</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<form name = "updateProfileForm" id = "updateProfileForm" method = "post"> 
			<h5>First Name: </h5><input readonly value = <?php echo $person['FirstName'] ?>><br><br>
			<h5>Last Name: </h5><input readonly value = <?php echo $person['LastName'] ?>><br><br>
			<h5>Email: </h5><input id = "email" name = "email" value = <?php echo $person['Email'] ?>><br><br>
			<h5>Login: </h5><input readonly value = <?php echo $person['Login'] ?> ><br><br>
			<h5>Password: </h5><input id = "password" name = "password" value = <?php echo $person['Password'] ?>><br><br>
			<h5>Creation Date: </h5><input readonly value = <?php echo $person['CreateDate']?>><br><br>
			
			<button class = "btn btn-lg btn-primary btn-block" type = "submit">update</button>
			
			<h5 <?php if($updateStatus == ""){echo "hidden";}?>>update status: success</h5>
		</form>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>