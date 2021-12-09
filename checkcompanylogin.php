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
	//$sql="SELECT id_user, firstname, lastname, email FROM users WHERE email='$email' AND password='$password'";// check from the database if the user exists and give a result
	//consider checking the problem with the syntax above
	$sql="SELECT id_company, companyname, headofficecity,contactno, email FROM company WHERE email='$email' AND password='$password'";
	$result=$conn ->query($sql);

	if($result->num_rows > 0){
		//output data
		while($row=$result->fetch_assoc()){
			$_SESSION['companyname']=$row['companyname'];
			$_SESSION['headofficecity']=$row['headofficecity'];
			$_SESSION['email']=$row['email'];
			$_SESSION['id_company']=$row['id_company'];
			$_SESSION['companyloggedin']=true;
			header("Location: company/dashboard.php");
			exit();}
	}else{
		$_SESSION['loginError']=true;
		header("Location: company-login.php");
		exit();
		}
}else{
	//redirect them back to login page
	header("Location: company-login.php");
	exit();
}
?>