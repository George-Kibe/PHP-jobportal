<?php
session_start();

if(empty($_SESSION['id_admin'])){
		header("Location: index.php");
		exit();
	} //This ensures only the admin can delete users
require_once("../db.php");

if(isset($_GET)){
	$sql="DELETE FROM job_post WHERE id_jobpost='$_GET[id]'";
	if($conn ->query($sql)){
		$sql1="DELETE FROM apply_job_post WHERE id_job_post='$_GET[id]'";
		if($conn ->query($sql1)){
		header("Location: job-posts.php");
		exit();
		}
		header("Location: job-posts.php");
		exit();

	}else{
		echo "Error";
	}
}




?>