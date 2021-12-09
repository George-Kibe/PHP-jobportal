<?php
session_start();
require_once("db.php"); //for connecting and checking connection status

//if user clicked login button
if(isset($_POST)){
	
	//escape special characters in strings
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	//encrypt password
	$password=base64_encode(strrev(md5($password)));
	$sql="SELECT id_user, firstname, lastname, email FROM users WHERE email='$email' AND password='$password'";// check from the database if the user exists and give a result	
	$result=$conn ->query($sql);

	if($result->num_rows > 0){
		//output data
		while($row=$result->fetch_assoc()){
			$_SESSION['LoginSuccess']=true;
			$_SESSION['name']=$row['firstname']." ".$row['lastname'];
			$_SESSION['email']=$row['email'];
			$_SESSION['id_user']=$row['id_user'];

			if(isset($_SESSION['callFrom'])){
				$location= $_SESSION['callFrom'];
				unset($_SESSION['callFrom']);
				header("Location: ".$location);
			exit();
			}else{
			header("Location: user/dashboard.php");
			exit();}
		}
	}else{
		$_SESSION['loginError']=true;
		header("Location: login.php");
		exit();
		}
		$conn ->close();
}else{
	//redirect them back to login page
	header("Location: login.php");
	exit();
}