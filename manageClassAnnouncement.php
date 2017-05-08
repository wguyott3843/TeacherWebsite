<?php
	include('database php/session.php');
	include('database php/classAnnouncements.php');
   
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(isset($_POST['operation'])){
			$operation = $_POST['operation'];
			if($operation == 'add'){
				$_SESSION['announcement_description'] = $_POST['announcementDescription'];
				$_SESSION['announcement_text'] = $_POST['announcementText'];
				header("location:addClassAnnouncement.php");
			}
			elseif($operation == 'delete'){
				header("location:deleteClassAnnouncement.php");
			}
			elseif($operation == 'update'){
				$_SESSION['announcement_description'] = $_POST['announcementDescription'];
				$_SESSION['announcement_text'] = $_POST['announcementText'];
				header("location:updateClassAnnouncement.php");
			}
			elseif($operation == 'setAnnouncementId'){
				$announcementId = $_POST['announcementId'];
				$_SESSION['announcement_id'] = $announcementId;
				header("location: manageClassAnnouncement.php");
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
		$numberOfAnnouncements = sizeof($announcements);
	   
		if($numberOfAnnouncements > 0){
			if (isset($_SESSION['announcement_id'])) {
				$announcementId = $_SESSION['announcement_id'];
			}
			else{
				$announcementId = $announcements[0]['AnnouncementId'];
			}
			
			// I have to set the announcementId in session here for the initally selected announcement.  
			// If the user selects any other announcement the announcementId gets set in session as part of the user changing the current selection.
			$_SESSION['announcement_id'] = $announcementId;
			
			foreach($announcements as $announcement): 
				if($announcement['AnnouncementId'] == $announcementId){
					$announcementDescription = $announcement['Description'];
					$announcementText = $announcement['Text'];
					break;
				}
			endforeach;
		}
		else{
			$announcementId = -1;
			$announcementDescription = "";
			$announcementText = "";
		}
	}
?>

<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta http-equiv = "X-UA-Compatible" content = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name = "description" content = "Edit Announcement Page">
    <meta name = "author" content = "William Guyott">
	<link rel = "icon" href = "images/Apple.ico">
	
    <title>Edit Announcements</title>
	
	<!-- Bootstrap core CSS -->
    <link href = "bootstrap/css/bootstrap.min.css" rel = "stylesheet">
	
	<!-- Custom styles for this template -->
    <link href = "css/signin.css" rel = "stylesheet">
  </head>
  <body>
    <div class = "container">
		<form name = "selectAnnouncementForm" id = "selectAnnouncementForm" method = "post">
			<div class = "form-group">
				<input class = "span2" id = "announcementId" name = "announcementId" type = "hidden">
				<input class = "span2" id = "operation" name = "operation" type = "hidden">
				<label for = "announcementList">Select list (select one):</label>
					<select class = "form-control" id = "announcementList" onchange = "SetAnnouncementIdAndPost(this.value)">
						<?php foreach($announcements as $announcement): ?>
							<option value = <?php echo $announcement['AnnouncementId'] ?> <?php if($announcement['AnnouncementId'] == $announcementId){echo "selected";}?>><?php echo $announcement['Description']; ?></option> 
						<?php endforeach;?>
					</select>
			</div>
			<div class = "form-group">
				<label for = "announcementDescription">Description:</label>
				<textarea class = "form-control" form = "selectAnnouncementForm" style = "resize:none" maxLength = 20 rows = 1 cols = 20 id = "announcementDescription" name = "announcementDescription" required><?php echo $announcementDescription; ?></textarea>
				<br>
				<label for = "announcementText">Text:</label>
				<textarea class = "form-control" form = "selectAnnouncementForm" style = "resize:none" maxLength = 500 rows = 7 cols = 80 id = "announcementText" name = "announcementText" required><?php echo $announcementText; ?></textarea>
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
			<ul style = "list-style-type: none">
				<li><a href = "manageClass.php" class = "btn btn-default">back</a></li>
				<li><a href = "logout.php" class = "btn btn-default">logout</a></li>
			</ul>
		</div>
    </div> <!-- /container -->
	
	<!-- Put all javascript at the end of the body so the UI elements get rendered first.
		 This makes the webpage seem more responsive to the user. -->
	<script>
		function SetAnnouncementIdAndPost(announcementId) {
			document.getElementById("operation").value = 'setAnnouncementId';
			document.getElementById("announcementId").value = announcementId;
			document.selectAnnouncementForm.submit();
		}
		
		function SetOperationAndPost(operation){
			document.getElementById("operation").value = operation;
			document.selectAnnouncementForm.submit();
		}
	</script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src = "bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>