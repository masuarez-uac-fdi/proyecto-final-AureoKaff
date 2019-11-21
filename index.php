<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <style>
        * {
            font-family: 'Cisco Sans'; 
        }
    </style>
</head>
<body>

<div class="header">
    <h2 style="margin: 0px; border: 0%; padding: 0%;">Cisco</h2>
    <h3 style="margin: 0px; border: 0%; padding: 0%;">Networking Academy Builds IT Skills & Education for future Careers</h3>
</div>
<div class="content">
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
              unset($_SESSION['success']);
              echo $id;
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <?php  if (isset($_SESSION['username'])) : ?>
    	<p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
    	<p> <a href="Mainpage.php" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
		
</body>
</html>