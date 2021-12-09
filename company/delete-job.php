<?php
session_start(); //start session
require_once("../db.php");

//If user clicks the register button
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	//isset means if user inputs anything in the form	
	$sql="DELETE FROM job_post WHERE id_jobpost='$_GET[id]' AND id_company='$_SESSION[id_company]'";
	//$sql="DELETE FROM `job_post` WHERE `job_post`.`id_jobpost` = '$_GET[target_id]'";
		
	if($conn->query($sql)===TRUE){
		$_SESSION['jobPostDeletedSuccess']=true;
		header("Location: dashboard.php"); //header is used to redirect
		exit();			
	}else{echo "Error ".$sql."<br>".$conn->error;
	}
		$conn ->close(); //close connection		
	
}else{ //if user do not put anything on the form redirect them to
	header("Location:dashboard.php");
	exit();
}

?>