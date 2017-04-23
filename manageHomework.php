<?php
	include('database php/session.php');
	include('database php/homework.php');
   
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['operation'])){
			$operation = $_POST['operation'];
			if($operation == 'add'){
				$_SESSION['homework_expiration_date'] = $_POST['homeworkExpirationDate'];
				$_SESSION['homework_text'] = $_POST['homeworkText'];
				header("location:addHomework.php");
			}
			elseif($operation == 'delete'){
				header("location:deleteHomework.php");
			}
			elseif($operation == 'update'){
				$_SESSION['homework_expiration_date'] = $_POST['homeworkExpirationDate'];
				$_SESSION['homework_text'] = $_POST['homeworkText'];
				header("location:updateHomework.php");
			}
			elseif($operation == 'setHomeworkId'){
				$homeworkId = $_POST['homeworkId'];
				$_SESSION['homework_id'] = $homeworkId;
				header("location: manageHomework.php");
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
		$numberOfHomeworks = sizeof($homeworks);
	   
		if($numberOfHomeworks > 0){
			if (isset($_SESSION['homework_id'])) {
				$homeworkId = $_SESSION['homework_id'];
			}
			else{
				$homeworkId = $homeworks[0]['HomeworkId'];
			}
			
			// I have to set the homeworkId in session here for the initally selected homework.  
			// If the user selects any other homework the homeworkId gets set in session as part of the user changing the current selection.
			$_SESSION['homework_id'] = $homeworkId;
			
			foreach($homeworks as $homework): 
				if($homework['HomeworkId'] == $homeworkId){
					$homeworkExpirationDate = $homework['ExpirationDate'];
					$homeworkText = $homework['Text'];
					break;
				}
			endforeach;
		}
		else{
			$homeworkId = -1;
			$homeworkExpirationDate = "";
			$homeworkText = "";
		}
	}
?>

<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name = "description" content = "Edit Homework Page">
    <meta name = "author" content = "William Guyott">
	<link rel = "icon" href = "images/Apple.ico">
	
    <title>Edit Homework</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<form name = "selectHomeworkForm" id = "selectHomeworkForm" method = "post">
			<div class = "form-group">
				<input class = "span2" id = "homeworkId" name = "homeworkId" type = "hidden">
				<input class = "span2" id = "operation" name = "operation" type = "hidden">
				<label for = "homeworkList">Select list (select one):</label>
					<select class = "form-control" id = "homeworkList" onchange = "SetHomeworkIdAndPost(this.value)">
						<?php foreach($homeworks as $homework): ?>
							<option value = <?php echo $homework['HomeworkId'] ?> <?php if($homework['HomeworkId'] == $homeworkId){echo "selected";}?>><?php echo $homework['Text']; ?></option> 
						<?php endforeach;?>
					</select>
			</div>
			<div class = "form-group">
				<label for = "homeworkText">Text:</label>
				<textarea class = "form-control" form = "selectHomeworkForm" style = "resize:none" maxLength = 50 rows = 1 cols = 50 id = "homeworkText" name = "homeworkText" required><?php echo $homeworkText; ?></textarea>
				<br>
				<label for = "homeworkExpirationDate">Expiration Date:</label>
				<textarea class = "form-control" form = "selectHomeworkForm" style = "resize:none" maxLength = 10 rows = 1 cols = 10 id = "homeworkExpirationDate" name = "homeworkExpirationDate" required><?php echo $homeworkExpirationDate; ?></textarea>
			</div>
		</form>
		
		<div style = "float:right">
		<h3>Manage Homework:</h3>
			<ul style = "list-style-type: none">
				<li><button onclick = "SetOperationAndPost('add')">add</button></li>
				<li><button onclick = "SetOperationAndPost('delete')">delete</button></li>
				<li><button onclick = "SetOperationAndPost('update')">update</button></li>
			</ul>
		</div>
		<div style = "float:right">
		<h3>Manage:</h3>
			<ul style = "list-style-type: noone">
				<li><a class = "btn" href = "manageClass.php" type = "button">cancel</a></li>
				<li><a class = "btn" href = "logout.php" type = "button">logout</a></li>
			</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
	<script>
		function SetHomeworkIdAndPost(homeworkId) {
			document.getElementById("operation").value = 'setHomeworkId';
			document.getElementById("homeworkId").value = homeworkId;
			document.selectHomeworkForm.submit();
		}
		
		function SetOperationAndPost(operation){
			document.getElementById("operation").value = operation;
			document.selectHomeworkForm.submit();
		}
	</script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>