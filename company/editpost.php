<?php
session_start(); //start session
require_once("../db.php");

//If user clicks the register button
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	//isset means if user inputs anything in the form
	//escape special characters
	$ujobtitle=mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$udescription=mysqli_real_escape_string($conn, $_POST['description']);
	$uminimumsalary=mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$umaximumsalary=mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$uexperience=mysqli_real_escape_string($conn, $_POST['experience']);
	$uqualification=mysqli_real_escape_string($conn, $_POST['qualification']);
	
	$sql="UPDATE job_post SET jobtitle='$ujobtitle', description='$udescription', minimumsalary='$uminimumsalary', maximumsalary='$umaximumsalary',  experience='$uexperience', qualification='$uqualification' WHERE  id_jobpost='$_POST[target_id]' AND id_company='$_SESSION[id_company]'";
	$update=$conn->query($sql);//
		
	if($update===TRUE){
		$_SESSION['jobPostUpdateSuccess']=true;
		header("Location: dashboard.php"); //header is used to redirect
		exit();			
	}else{echo "Error ".$sql."<br>".$conn ->error;
		}
		$conn ->close(); //close connection		
	
}else{ //if user do not put anything on the form redirect them to
	header("Location:dashboard.php");
	exit();
}

?>