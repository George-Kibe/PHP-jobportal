<?php
session_start(); //start session
require_once("../db.php");

//If user clicks the register button
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	//isset means if user inputs anything in the form
	$sql="SELECT * FROM job_post WHERE id_jobpost='$_GET[id]'";	
	$result=$conn ->query($sql);
	if($result->num_rows > 0){
		$row=$result ->fetch_assoc();
		$id_company=$row['id_company'];
		}		
	
	$sql1="SELECT * FROM apply_job_post WHERE id_user='$_SESSION[id_user]' AND id_job_post='$row[id_jobpost]'";
	$result1=$conn ->query($sql1);
	if($result1->num_rows == 0){
		$sql="INSERT INTO apply_job_post(id_job_post,id_company, id_user) VALUES('$_GET[id]', '$id_company', '$_SESSION[id_user]')";		
		if($conn->query($sql)===TRUE){
			$_SESSION['jobApplySuccess']=true;
			header("Location: dashboard.php"); //header is used to redirect
			exit();			
		}else{echo "Error ".$sql."<br>".$conn->error;
		}
		$conn ->close(); //close connection		
	
	}else{
	header("Location:dashboard.php");
	exit();
}
}else{
	header("Location:dashboard.php");
	exit();
}
?>