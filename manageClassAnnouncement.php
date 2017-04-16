<?php
   include('database php/session.php');
   include('database php/classes.php');
   
   if($_SERVER["REQUEST_METHOD"] == "POST"){
	   
		if(isset($_POST['classId'])){
			$classId = $_POST['classId'];
			$_SESSION['class_id'] = $classId;
			header("location: studentAnnouncement.php");
		}
		else{
			header("location:logout.php");
		}
	}
	else{
		$numberOfClasses = sizeof($classes);
	   
		if($numberOfClasses > 0){
			if (isset($_SESSION['class_id'])) {
				$classId = $_SESSION['class_id'];
			}
			else{
				$classId = $classes[0]['ClassId'];
			}
		}
		else{
			$classId = -1;
		}
		
		$announcements = array();
		
		try
		{
			$sql = "SELECT Id AS AnnouncementId, Text, ExpirationDate FROM Announcement WHERE ClassId = '$classId' AND DeleteDate IS NULL ORDER BY ExpirationDate ASC";
			$announcementResult = mysqli_query($db,$sql);
			while($row = mysqli_fetch_array($announcementResult,MYSQLI_ASSOC))
			{
				$announcements[] = $row;
			}
		}
		catch(Exception $e)
		{
			die("Database Error: " . $e->getMessage());
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
	
    <title>Announcements</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<form name = "selectClassForm" id = "selectClassForm" method = "post">
			<div class = "form-group">
				<input class = "span2" id = "classId" name = "classId" type = "hidden">
				<label for = "classList">Select list (select one):</label>
					<select class = "form-control" id = "classList" onchange = "SetClassIdAndPost(this.value)">
						<?php foreach($classes as $class): ?>
							<option value = <?php echo $class['ClassId'] ?> <?php if($class['ClassId'] == $classId){echo "selected";}?>><?php echo $class['Name']; ?></option> 
						<?php endforeach;?>
					</select>
			</div>
		</form>
		<div>
			<h2>Announcements</h2>
			<div style = "overflow: scroll; height: 500px;">
				<table class = "table table-striped table-bordered">
					<tbody>
						 <?php foreach($announcements as $announcement): ?>
							 <tr>
								 <td><?php echo $announcement['ExpirationDate']; ?></td>
								 <td><?php echo $announcement['Text']; ?></td>
							 </tr>
						 <?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div style = "float:right">
			<h3>Manage:</h3>
				<ul style = "list-style-type: none">
					<li><a class = "btn" href = "teacherClasses.php" type = "button">cancel</a></li>
					<li><a class = "btn" href = "logout.php" type = "button">logout</a></li>
				</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
	<script>
		function SetClassIdAndPost(classId) {
			document.getElementById("classId").value = classId;
			document.selectClassForm.submit();
		}
	</script>
		 
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>