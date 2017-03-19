<?php
	include('session.php');
	include('classes.php');
   
	$numberOfClasses = sizeof($classes);
   
	if($numberOfClasses > 0){
		if (isset($_GET['classId'])) {
			$classId = $_GET['classId'];
		}
		else{
			$classId = $classes[0]['ClassId'];
		}
		
		foreach($classes as $class): 
			if($class['ClassId'] == $classId){
				$classNumber = $class['Number'];
				$className = $class['Name'];
				$classDescription = $class['Description'];
				break;
			}
		endforeach;
	}
	else{
		$classId = -1;
		$classNumber = "";
		$className = "";
		$classDescription = "";
	}

?>

<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name = "description" content = "Edit Class Page">
    <meta name = "author" content = "William Guyott">
	<link rel = "icon" href = "images/Apple.ico">
	
    <title>Edit Class</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<form name = "selectClassForm" id = "selectClassForm" method = "get">
			<div class = "form-group">
				<input class = "span2" id = "classId" name = "classId" type = "hidden">
				<label for = "classList">Select list (select one):</label>
					<select class = "form-control" id = "classList" onchange = "window.location='editClass.php?classId='+this.value">
						<?php foreach($classes as $class): ?>
							<option value = <?php echo $class['ClassId'] ?> <?php if($class['ClassId'] == $classId){echo "selected";}?>><?php echo $class['Name']; ?></option> 
						<?php endforeach;?>
					</select>
			</div>
			<div class="form-group">
				<label for="classNumber">Class Number:</label>
				<textarea class = "form-control" form = "selectClassForm" style = "resize:none" maxLength = 9 rows = 1 cols = 9 id = "classNumber" name = "classNumber" required><?php echo $classNumber; ?></textarea>
				<br>
				<label for="className">Class Name:</label>
				<textarea class = "form-control" form = "selectClassForm" style = "resize:none" maxLength = 40 rows = 1 cols = 40 id = "className" name = "className" required><?php echo $className; ?></textarea>
				<br>
				<label for="classDescription">Class Description:</label>
				<textarea class = "form-control" form = "selectClassForm" style = "resize:none" maxLength = 500 rows = 7 cols = 80 id = "classDescription" name = "classDescription" required><?php echo $classDescription; ?></textarea>
			</div>
		</form>
		
		<div style = "float:right">
		<h3>Manage Class:</h3>
			<ul style = "list-style-type: none">
				<li><a class = "btn" href = "addClass.php" type = "button">add</a></li>
				<li><a class = "btn" href = "deleteClass.php" type = "button">delete</a></li>
				<li><a class = "btn" href = "updateClass.php" type = "button">update</a></li>
			</ul>
		</div>
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: none">
				<li><a class = "btn" href = "manageHomework.php" type = "button">homework</a></li>
				<li><a class = "btn" href = "manageClassAnnouncement.php" type = "button">announcements</a></li>
				<li><a class = "btn" href = "teacherClasses.php" type = "button">cancel</a></li>
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