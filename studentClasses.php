<?php
   include('database php/session.php');
   include('database php/classes.php');
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
	
    <title>Classes</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<div>
			<h2>Assigned Classes</h2>
			<div style = "overflow: scroll; height: 500px;">
				<table class = "table table-striped table-bordered">
					<tbody>
						 <?php foreach($classes as $row): ?>
							 <tr>
								 <td><?php echo $row['Number']; ?></td>
								 <td><?php echo $row['Name']; ?></td>
							 </tr>
						 <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: none">
				<li><a href = "studentHomework.php" class = "btn btn-default">homework</a></li>
				<li><a href = "studentAnnouncement.php" class = "btn btn-default">announcements</a></li>
				<li><a href = "welcomeStudent.php" class = "btn btn-default">back</a></li>
				<li><a href = "logout.php" class = "btn btn-default">logout</a></li>
			</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>