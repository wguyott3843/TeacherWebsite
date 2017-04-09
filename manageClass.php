<?php
	include('database php/session.php');
	include('database php/classes.php');
   
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['operation'])){
			$operation = $_POST['operation'];
			if($operation == 'add'){
				$_SESSION['class_number'] = $_POST['classNumber'];
				$_SESSION['class_name'] = $_POST['className'];
				$_SESSION['class_description'] = $_POST['classDescription'];
				header("location:addClass.php");
			}
			elseif($operation == 'delete'){
				header("location:deleteClass.php");
			}
			elseif($operation == 'update'){
				$_SESSION['class_number'] = $_POST['classNumber'];
				$_SESSION['class_name'] = $_POST['className'];
				$_SESSION['class_description'] = $_POST['classDescription'];
				header("location:updateClass.php");
			}
			elseif($operation == 'setClassId'){
				$classId = $_POST['classId'];
				$_SESSION['class_id'] = $classId;
				header("location: manageClass.php");
			}
			else{
				header("location:logout.php");
			}
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
		<form name = "selectClassForm" id = "selectClassForm" method = "post">
			<div class = "form-group">
				<input class = "span2" id = "classId" name = "classId" type = "hidden">
				<input class = "span2" id = "operation" name = "operation" type = "hidden">
				<label for = "classList">Select list (select one):</label>
					<select class = "form-control" id = "classList" onchange = "SetClassIdAndPost(this.value)">
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
				<li><button onclick = "SetOperationAndPost('add')">add</button></li>
				<li><button onclick = "SetOperationAndPost('delete')">delete</button></li>
				<li><button onclick = "SetOperationAndPost('update')">update</button></li>
			</ul>
		</div>
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: none">
				<li><a class = "btn" href = "teacherHomework.php" type = "button">homework</a></li>
				<li><a class = "btn" href = "manageClassAnnouncement.php" type = "button">announcements</a></li>
				<li><a class = "btn" href = "teacherClasses.php" type = "button">cancel</a></li>
				<li><a class = "btn" href = "logout.php" type = "button">logout</a></li>
			</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
	<script>
		function SetClassIdAndPost(classId) {
			document.getElementById("operation").value = 'setClassId';
			document.getElementById("classId").value = classId;
			document.selectClassForm.submit();
		}
		
		function SetOperationAndPost(operation){
			document.getElementById("operation").value = operation;
			document.selectClassForm.submit();
		}
	</script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>