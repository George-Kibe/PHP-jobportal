<?php
	session_start();
	//echo('Welcome to my website '.$_SESSION['name']);
	if(empty($_SESSION['id_company'])){
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
		  <a class="navbar-brand" href="../index.php">Job Portal </a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		  <ul class="nav navbar-nav navbar-right ">
			<li class="col-md-4"><a href="profile.php">Profile</a></li>
			<li class="col-md-4"><a href="../logout.php">Logout</a></li>
			<li class="col-md-4"><a href="../blog.html">Blog</a></li>		
		  </ul>
		</div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	</header>

	<div class="container successMessage">
		<?php if(isset($_SESSION['jobPostSuccess'])) {?>
			<div class="row">
				<div class="alert alert-success">
					Job Post Created Successfully!
				</div>
			</div>
		<?php unset($_SESSION['jobPostSuccess']);}?>
		<?php if(isset($_SESSION['jobPostUpdateSuccess'])) {?>
			<div class="row">
				<div class="alert alert-success">
					Job Post Updated Successfully!
				</div>
			</div>
		<?php unset($_SESSION['jobPostUpdateSuccess']);}?>
		<?php if(isset($_SESSION['jobPostDeletedSuccess'])) {?>
			<div class="row">
				<div class="alert alert-success">
					Job Post Deleted Successfully!
				</div>
			</div>
		<?php unset($_SESSION['jobPostDeletedSuccess']);}?>
	</div>
		<div class="row">
			<h2 class="text-center">Dashboard</h2>
			<div class="col-md-3">
				<a href="create-job-post.php" class="btn btn-success btn-block btn-lg">Create A New Job</a>
			</div>
			<div class="col-md-3">
				<?php 
				$sql1="SELECT * FROM job_post WHERE id_company=$_SESSION[id_company]"  ;
				$result1=$conn ->query($sql1);
				?>
				<a href="view-job-post.php" class="btn btn-success btn-block btn-lg">View Jobs Posted by Me <span class="badge"><?php echo $result1 ->num_rows; ?></span></a>
			</div>
			<div>
				<?php
				$sql="SELECT * FROM apply_job_post WHERE id_company=$_SESSION[id_company] AND status='0'";
				$result=$conn ->query($sql);
				if($result ->num_rows >0){
					?>
					<div class="col-md-3">
						<a href="view-job-application.php" class="btn btn-success btn-block btn-lg">View Applications <span class="badge"><?php echo $result ->num_rows; ?></span></a>
					</div>
					<?php
				}
				?>
			</div>
		</div>

	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--<script src="js/bootstrap.min.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script type="text/javascript">
		$(function(){ //when document is loading success message dissappers after 4 seconds
			$(".successMessage:visible").fadeOut(4000);

		});
	</script>
  </body>
</html>