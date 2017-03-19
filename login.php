<?php
   include("config.php");
   session_start();
   
   $error = '';
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT Id, FirstName, LastName, Email FROM Person WHERE Login = '$myusername' and Password = '$mypassword' and DeleteDate IS NULL";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $personid = $row['Id'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, there should only be 1 row
		
      if($count == 1) {
		 // saving useful information from the person table into session state
		 
		 $firstname = $row['FirstName'];
		 $lastname = $row['LastName'];
		 $email = $row['Email'];
		 
		 $sql = "SELECT Id FROM Teacher WHERE PersonId = '$personid'";
		 $result = mysqli_query($db,$sql);
		 
		 $count = mysqli_num_rows($result);
		 
		 if($count == 1){
			 // we have a teacher
			 
			 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			 $teacherid = $row['Id'];
			 
			 $_SESSION['teacher_id'] = $teacherid;
			 $_SESSION['login_user'] = $myusername;			 
			 $_SESSION['first_name'] = $firstname;			 
			 $_SESSION['last_name'] = $lastname;			 
			 $_SESSION['email'] = $email;
			 $_SESSION['person_id'] = $personid;
		 
			 header("location: welcomeTeacher.php");
		 }
		 else{
			 // need to check if this is a student
			 
			 $sql = "SELECT Id FROM Student WHERE PersonId = '$personid'";
			 $result = mysqli_query($db,$sql);
		 
			 $count = mysqli_num_rows($result);
			 
			 if($count == 1){
				 // we have a student
				 
				 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				 $studentid = $row['Id'];
			 
				 $_SESSION['student_id'] = $studentid;	  
				 $_SESSION['login_user'] = $myusername;
				 $_SESSION['first_name'] = $firstname;			 
				 $_SESSION['last_name'] = $lastname;				 
				 $_SESSION['email'] = $email;
				 $_SESSION['person_id'] = $personid;
			 
				 header("location: welcomeStudent.php");
			 }
			 else{
				 // its neither
				 $error = "Your Login Name or Password is invalid.";
			 }
		 }
      }else {
         $error = "Your Login Name or Password is invalid.";
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
	
    <title>Login</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">

      <form class = "form-signin" method = "post">
        <h2 class = "form-signin-heading">Please Login</h2>
        <label for = "username" class = "sr-only">Username</label>
        <input type = "text" id = "username" name = "username" class = "form-control" placeholder = "Username" required autofocus>
        <label for = "password" class = "sr-only">Password</label>
        <input type = "password" id = "password" name = "password" class = "form-control" placeholder = "Password" required>
        <!-- <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div> -->
        <button class = "btn btn-lg btn-primary btn-block" type = "submit">Login</button>
      </form>

    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>