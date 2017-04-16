<?php
    include('database php/session.php');
	include('database php/students.php');
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
	
    <title>Students</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
	
		<div>
			<h2>Homeroom Students</h2>
			<div style = "overflow: scroll; height: 500px;">
				<table class = "table table-striped table-bordered">
					<tbody>
						 <?php foreach($students as $row): ?>
							 <tr>
								 <td><?php echo $row['LastName']; ?></td>
								 <td><?php echo $row['FirstName']; ?></td>
								 <td><?php echo $row['GradeLevel']; ?></td>
								 <td><?php echo $row['Email']; ?></td>
								 <td><?php echo $row['Login']; ?></td>
							 </tr>
						 <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: none">
				<li><a class = "btn" href = "manageStudent.php" type = "button">modify</a></li>
				<li><a class = "btn" href = "welcomeTeacher.php" type = "button">cancel</a></li>
				<li><a class = "btn" href = "logout.php" type = "button">logout</a></li>
			</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>