<?php
	include('database php/session.php');
	
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
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: none">
				<li><a class = "btn" href = "teacherProfile.php" type = "submit">profile</button></li>
				<li><a class = "btn" href = "teacherClasses.php" type = "button">classes</button></a></li>
				<li><a class = "btn" href = "studentList.php" type = "submit">students</button></li>
				<li><a class = "btn" href = "teacherAnnouncement.php" type = "submit">announcements</button></li>
				<li><a class = "btn" href = "logout.php" type = "button">logout</button></a></li>
			</ul>
		</div>
		<div style = "float:left">
			<p> Note: Under "classes" we have "homework" and "anouncements"</p>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>