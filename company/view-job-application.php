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
	<div class="container">
		<div class="row">
			<h2 class="text-center">User Applications</h2>
			<table class="table">
				<thead>
					<th>Job Post Name</th>
					<th>Job Description</th>
					<th>User Name</th>
					<th>Action</th>
				</thead>
				<tbody>
					<?php
					$sql="SELECT * FROM apply_job_post INNER JOIN job_post ON apply_job_post.id_job_post=job_post.id_jobpost INNER JOIN users ON apply_job_post.id_user=users.id_user WHERE apply_job_post.id_company='$_SESSION[id_company]' AND apply_job_post.status='0'";
					$result=$conn ->query($sql);
					if($result ->num_rows>0){
						while($row=$result ->fetch_assoc()){
							?>
							<tr>
								<td><?php echo $row['jobtitle']; ?></td>
								<td><?php echo $row['description']; ?></td>
								<td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
								<td><a href="view-application.php?id_user=<?php echo $row['id_user']; ?>&id_jobpost=<?php echo $row['id_jobpost']; ?>">View</a></td>
							</tr>
							<?php

						}
					}
					?>
				</tbody>
			</table>
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