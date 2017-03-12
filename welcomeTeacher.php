<?php
   include('session.php');
?>

<html">
   
   <head>
      <title>Welcome Teacher</title>
   </head>
   
   <body>
      <h1>Welcome Teacher <?php echo $_SESSION['first_name']; ?></h1> 
      <h2><a href = "logout.php">Logout</a></h2>
   </body>
   
</html>