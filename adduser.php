<?php
session_start(); //start session
require_once("db.php");

//If user clicks the register button
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	//isset means if user inputs anything in the form
	//escape special characters
	$firstname=mysqli_real_escape_string($conn, $_POST['fname']);
	$lastname=mysqli_real_escape_string($conn, $_POST['lname']);
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	
	//Encrypt password
	$password=base64_encode(strrev(md5($password)));

	$sql="SELECT email FROM users WHERE email='$email'";
	$result=$conn ->query($sql);

		if($result->num_rows == 0){

		$sql="INSERT INTO users(firstname, lastname, email, password) VALUES('$firstname', '$lastname','$email', '$password')";
		
		if($conn->query($sql)===TRUE){
			$_SESSION['registerCompleted']=true;
			header("Location:login.php"); //header is used to redirect
			exit();
			
		}else{echo "Error".$sql."<br>".$conn->error;}
		$conn ->close(); //close connection
		}else{
		$_SESSION['registerError']=true;
		header("Location: register.php");
		exit();
	}

}else{ //if user do not put anything on the form redirect them to
	header("Location:Register.php");
	exit();
}

?>