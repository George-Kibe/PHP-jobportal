<?php
session_start(); //start session
require_once("../db.php");

//If user clicks the register button
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	//isset means if user inputs anything in the form
	//escape special characters
	$jobtitle=mysqli_real_escape_string($conn, $_POST['jobtitle']);
	$description=mysqli_real_escape_string($conn, $_POST['description']);
	$minimumsalary=mysqli_real_escape_string($conn, $_POST['minimumsalary']);
	$maximumsalary=mysqli_real_escape_string($conn, $_POST['maximumsalary']);
	$experience=mysqli_real_escape_string($conn, $_POST['experience']);
	$qualification=mysqli_real_escape_string($conn, $_POST['qualification']);
	
	$sql="INSERT INTO job_post(id_company, jobtitle, description, minimumsalary, maximumsalary,  experience, qualification) VALUES('$_SESSION[id_company]', '$jobtitle', '$description','$minimumsalary', '$maximumsalary', '$experience', '$qualification')";
		
	if($conn->query($sql)===TRUE){
		$_SESSION['jobPostSuccess']=true;
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