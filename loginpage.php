<!-- link href=”bootstrap/css/bootstrap.min.css” rel=”stylesheet” type=”text/css” / -->
<!-- script type=”text/javascript” src=”bootstrap/js/bootstrap.min.js”></script -->

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
         
		 
			 // redirect to a different page in the current directory
			 //$host  = $_SERVER['HTTP_HOST'];
			 //$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			 //$extra = 'welcome.php';
			 //header("Location: http://$host$uri/$extra");
		 
		 
		 
			 header("location: welcome.php");
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
			 
				 header("location: welcome.php");
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

<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>