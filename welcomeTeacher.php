<?php
	include('database php/session.php');
	
	// This is needed to handle the case were the user comes in here and goes back to the previous page then comes back here again.
	// The old announcement_id value is no longer correct and needs to be cleared here.
	unset($_SESSION['announcement_id']);
	
	$data = array();
	try
	{
		$result = mysqli_query($db,"SELECT Text FROM Announcement WHERE ClassId IS NULL AND ExpirationDate >= CURDATE() ORDER BY CreateDate DESC;");
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
			$data[] = $row;
		}
	}catch(Exception $e)
	{
		 die("Database Error: " . $e->getMessage());
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
	
    <title>Welcome</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: none">
				<li><a href = "teacherProfile.php" class = "btn btn-default">profile</a></li>
				<li><a href = "teacherClasses.php" class = "btn btn-default">classes</a></li>
				<li><a href = "teacherStudents.php" class = "btn btn-default">students</a></li>
				<li><a href = "manageGlobalAnnouncement.php" class = "btn btn-default">announcements</a></li>
				<li><a href = "logout.php" class = "btn btn-default">logout</a></li>
			</ul>
		</div>
	
		<div>
			<h2>Current Announcements</h2>
			<div style = "overflow: scroll; height: 500px;">
				<table class = "table table-striped table-bordered">
					<tbody>
						 <?php foreach($data as $row): ?>
							 <tr>
								 <td><?php echo $row['Text']; ?></td>
							 </tr>
						 <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>