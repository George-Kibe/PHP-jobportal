<?php
session_start();
if(empty($_SESSION["id_user"])){//if user is not logged in direct them to index.php
		header("Location: index.php");
		exit();
	}
require_once("../db.php"); //starts connection
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Job Portal</title>

    <!-- Bootstrap -->
   <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!--NAVIGATION BAR-->
   <header>
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">Job Portal </a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="profile.php">Profile</a></li>
			<li><a href="../logout.php">Logout</a></li>
			<li><a href="#">Blog</a></li>
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</header>
	
	<section>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 well">
			<h2 class="text-center">Profile</h2>
			<form method="post" action="updateprofile.php">
			  <?php
			  $sql="SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
			  $result=$conn ->query($sql);

			  if($result ->num_rows > 0){
			  while($row=$result->fetch_assoc()){
			  ?>			
			  <div class="form-group">
				<label for="fname">First Name</label>
				<input type="name" class="form-control" id="fname" name="fname" placeholder="firstname" value="<?php echo $row['firstname']; ?>" required="">
			  </div>
			  <div class="form-group">
				<label for="lname">Last Name</label>
				<input type="name" class="form-control" id="lname" name="lname" placeholder="lastname" value="<?php echo $row['lastname']; ?>" required="">
			  </div>
			  <div class="form-group">
				<label for="email">Email address</label>
				<input type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $row['email']; ?>" readonly><!--No editing email because it is unique so read only-->
			  </div>
			  <div class="form-group">
				<label for="state">State</label>
				<input type="state" class="form-control" id="state" name="state" placeholder="State" value="<?php echo $row['state']; ?>">
			  </div>
			  <div class="form-group">
				<label for="dateofbirth">Date of Birth</label>
				<input type="date" class="form-control" id="dateofbirth" name="dateofbirth" placeholder="Date of Birth" value="<?php echo $row['dateofbirth']; ?>">
			  </div>
			  <div class="form-group">
			  	<label for="city">City</label>
			  	<input type="text" class="form-control" id="city" name="city" placeholder="City" value="<?php echo $row['city']; ?>"></input>
			  	<div class="form-group">
			  	<label for="address">Address</label>
			  	<input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?php echo $row['address']; ?>"></input>			  	
			  </div>
			  <div class="form-group">
			  	<label for="hq">Highest Qualification</label>
			  	<textarea type="text" class="form-control" id="hq" name="hq" placeholder="Highest Qualification" value="<?php echo $row['hq']; ?>"></textarea>			  	
			  </div>
			  <div class="form-group">
			  	<label for="aboutyou">Brief Summary of You</label>
			  	<textarea type="text" class="form-control" id="aboutyou" name="aboutyou" placeholder="Brief Summary of You" rows="5"></textarea>			  	
			  </div>			  	
			  </div>
			  <div class="text-center">
			   <button type="submit" class="btn btn-success">Update Profile</button>
			   </div>
			   <?php
			   		}
			   	}
			   ?>

			</form>
			</div>
		</div>
	</div>
	</section>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="js/bootstrap.min.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>