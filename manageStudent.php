<?php
	include('database php/session.php');
	include('database php/students.php');
   
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['operation'])){
			$operation = $_POST['operation'];
			if($operation == 'add'){
				$_SESSION['person_lastname'] = $_POST['lastName'];
				$_SESSION['person_firstname'] = $_POST['firstName'];
				$_SESSION['person_email'] = $_POST['email'];
				$_SESSION['person_login'] = $_POST['login'];
				$_SESSION['person_password'] = $_POST['password'];
				$_SESSION['student_gradelevel'] = $_POST['gradeLevel'];
				header("location:addStudent.php");
			}
			elseif($operation == 'delete'){
				header("location:deleteStudent.php");
			}
			elseif($operation == 'update'){
				$_SESSION['person_lastname'] = $_POST['lastName'];
				$_SESSION['person_firstname'] = $_POST['firstName'];
				$_SESSION['person_email'] = $_POST['email'];
				$_SESSION['person_login'] = $_POST['login'];
				$_SESSION['person_password'] = $_POST['password'];
				$_SESSION['student_gradelevel'] = $_POST['gradeLevel'];
				header("location:updateStudent.php");
			}
			elseif($operation == 'setStudentId'){
				$studentId = $_POST['studentId'];
				$_SESSION['student_id'] = $studentId;
				header("location: manageStudent.php");
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
		$numberOfStudents = sizeof($students);

		if($numberOfStudents > 0){
			if (isset($_SESSION['student_id'])) {
				$studentId = $_SESSION['student_id'];
			}
			else{
				$studentId = $students[0]['StudentId'];
			}
			
			foreach($students as $student): 
				if($student['StudentId'] == $studentId){
					$firstName = $student['FirstName'];
					$lastName = $student['LastName'];
					$email = $student['Email'];
					$login = $student['Login'];
					$gradeLevel = $student['GradeLevel'];
					break;
				}
			endforeach;
		}
		else{
			$studentId = -1;
			$firstName = "";
			$lastName = "";
			$email = "";
			$login = "";
			$gradeLevel = "";
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
	
    <title>Edit Student</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<form name = "selectStudentForm" id = "selectStudentForm" method = "post">
			<div class = "form-group">
				<input class = "span2" id = "studentId" name = "studentId" type = "hidden">
				<input class = "span2" id = "operation" name = "operation" type = "hidden">
				<label for = "studentList">Select list (select one):</label>
					<select class = "form-control" id = "studentList" onchange = "SetStudentIdAndPost(this.value)">
						<?php foreach($students as $student): ?>
							<option value = <?php echo $student['StudentId'] ?> <?php if($student['StudentId'] == $studentId){echo "selected";}?>><?php echo $student['LastName']; echo ", "; echo $student['FirstName'];?></option> 
						<?php endforeach;?>
					</select>
			</div>
			<div class = "form-group">
				<label for = "firstName">First Name:</label>
				<textarea class = "form-control" form = "selectStudentForm" style = "resize:none" maxLength = 20 rows = 1 cols = 20 id = "firstName" name = "firstName" required><?php echo $firstName; ?></textarea>
				<br>
				<label for = "lastName">Last Name:</label>
				<textarea class = "form-control" form = "selectStudentForm" style = "resize:none" maxLength = 30 rows = 1 cols = 30 id = "lastName" name = "lastName" required><?php echo $lastName; ?></textarea>
				<br>
				<label for = "email">Email:</label>
				<textarea class = "form-control" form = "selectStudentForm" style = "resize:none" maxLength = 60 rows = 1 cols = 60 id = "email" name = "email" required><?php echo $email; ?></textarea>
				<br>
				<label for = "login">Login:</label>
				<textarea class = "form-control" form = "selectStudentForm" style = "resize:none" maxLength = 25 rows = 1 cols = 25 id = "login" name = "login" required><?php echo $login; ?></textarea>
				<br>
				<label for = "password">Password:</label>
				<textarea class = "form-control" form = "selectStudentForm" style = "resize:none" maxLength = 25 rows = 1 cols = 25 id = "password" name = "password"></textarea>
				<br>
				<label for = "gradeLevel">Grade Level:</label>
				<textarea class = "form-control" form = "selectStudentForm" style = "resize:none" maxLength = 2 rows = 1 cols = 2 id = "gradeLevel" name = "gradeLevel" required><?php echo $gradeLevel; ?></textarea>
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
				<li><a class = "btn" href = "teacherStudents.php" type = "button">cancel</a></li>
				<li><a class = "btn" href = "logout.php" type = "button">logout</a></li>
			</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
	<script>
		function SetStudentIdAndPost(studentId) {
			document.getElementById("operation").value = 'setStudentId';
			document.getElementById("studentId").value = studentId;
			document.selectStudentForm.submit();
		}
		
		function SetOperationAndPost(operation){
			document.getElementById("operation").value = operation;
			document.selectStudentForm.submit();
		}
	</script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>