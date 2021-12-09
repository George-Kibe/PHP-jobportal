<?php
session_start();
require_once("../db.php");

$sql="UPDATE apply_job_post SET status='1' WHERE id_user='$_GET[id_user]' AND id_job_post='$_GET[id_job_post]'";
if($conn ->query($sql)==TRUE){
	header("Location: view-job-application.php");
	exit();
}else{
	echo "Error!";
}
$conn ->close();



?>