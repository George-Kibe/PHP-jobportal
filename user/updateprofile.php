<?php
session_start();
require_once("../db.php");

//if user clicked the update profile button in profile page
if(isset($_POST)){
	//escape special characters
	$firstname=mysqli_real_escape_string($conn, $_POST['fname']); //$_POST['id from form']
	$lastname=mysqli_real_escape_string($conn, $_POST['lname']);
	$state=mysqli_real_escape_string($conn, $_POST['state']);
	$city=mysqli_real_escape_string($conn, $_POST['city']);
	$address=mysqli_real_escape_string($conn, $_POST['address']);
	$aboutyou=mysqli_real_escape_string($conn, $_POST['aboutyou']);
	$hq=mysqli_real_escape_string($conn, $_POST['hq']);
	$dateofbirth=mysqli_real_escape_string($conn, $_POST['dateofbirth']);

	//update query
	$sql="UPDATE users SET firstname='$firstname', lastname='$lastname', state='$state', city='$city', address='$address', aboutyou='$aboutyou', hq='$hq', dateofbirth='$dateofbirth' WHERE id_user='$_SESSION[id_user]'";
	if($conn ->query($sql) ===TRUE){
		header("Location: dashboard.php");
		exit();
	}else{
		echo "Error ".$sql."<br>".$conn ->error;
	}
	$conn ->close();

}else{
	header("Location: dashboard.php");
	exit();
}
?>