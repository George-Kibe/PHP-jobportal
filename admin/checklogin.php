<?php
session_start();
require_once("../db.php"); //for connecting and checking connection status

//if user clicked login button
if(isset($_POST)){
	
	//escape special characters in strings
	$username=mysqli_real_escape_string($conn, $_POST['username']);
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	//encrypt password
	//$password=base64_encode(strrev(md5($password)));
	$sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";// check from the database if the user exists and give a result	
	$result=$conn ->query($sql);

	if($result->num_rows > 0){
		//output data
		while($row=$result->fetch_assoc()){			
			$_SESSION['id_admin']=$row['id_admin'];
			header("Location: index.php");
			exit();}

		}else{
			$_SESSION['loginError']=true;
		header("Location: index.php");
		exit();
		}
		$conn ->close();
	
}else{
	//redirect them back to login page
	header("Location: index.php");
	exit();
}