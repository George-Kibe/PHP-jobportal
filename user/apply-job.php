<?php
	session_start();
	//echo('Welcome to my website '.$_SESSION['name']);
	if(empty($_SESSION['id_user'])){
		header("Location: ../index.php");
		exit();
	}
require_once("../db.php");

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
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</header>
<div class="container">
	<?php if(isset($_SESSION['LoginSuccess'])) {?>
			<div class="row">
				<div class="alert alert-success">Welcome <?php echo $_SESSION['name'];?> and Find Your dream Job Here 
				</div>
			</div>
		<?php unset($_SESSION['LoginSuccess']);}?>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
			$sql="SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";			
			$result=$conn ->query($sql);			
			if($result->num_rows > 0){
				while($row=$result->fetch_assoc()){
					$sql1="SELECT * FROM company WHERE id_company='$row[id_company]'";
					$result1=$conn ->query($sql1);
					$row1=$result1->fetch_assoc();
					$companyname=$row1['companyname'];
			?>
					<h2 class="text-center"><?php echo $row['jobtitle']; ?> Required At <?php echo $companyname ?></h2>
					<p>Job Description: <?php echo $row['description']; ?></p>
					<p>Minimum Salary is Kshs.<?php echo $row['minimumsalary']; ?></p>
					<p>Maximum Salary is Kshs.<?php echo $row['maximumsalary']; ?></p>
					<p>Minimum Experience Required is <?php echo $row['experience']; ?></p>
					<p>Qualification(s) Required : <?php echo $row['qualification']; ?></p>									
					<a href="apply.php?id=<?php echo $row['id_jobpost']; ?>" class="btn btn-primary">Apply This Job</a>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="js/bootstrap.min.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>