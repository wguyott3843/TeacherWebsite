<?php
   include('session.php');
   include('classes.php');
   
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
						<?php foreach($classes as $row): ?>
							<option value = <?php echo $row['ClassId'] ?>><?php echo $row['Name']; ?></option> 
							 <!-- <option onclick = "$('classId').val(<?php echo $row['classId'] ?>); $('#selectClassForm').submit()"><?php echo $row['Name']; ?></option> -->
						 <?php endforeach;?>
					</select>
			</div>
			<!--<label for = "classNumber" class = "sr-only">Class Number</label>-->
			<input type = "text" id = "classNumber" name = "classNumber" placeholder = "classNumber" value = <?php echo $classNumber; ?> required>
			<!--<label for = "className" class = "sr-only">Class Name</label>-->
			<input type = "text" id = "className" name = "className" placeholder = "className" value = <?php echo $className; ?> required>
			<!--<label for = "classDescription" class = "sr-only">Class Description</label>-->
			<input type = "text" id = "classDescription" name = "classDescription" placeholder = "classDescription" value = <?php echo $classDescription; ?> required>
		</form>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>