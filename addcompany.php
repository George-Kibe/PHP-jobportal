<?php
session_start(); //start session
require_once("db.php");

//If user clicks the register button
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	//isset means if user inputs anything in the form
	//escape special characters
	$companyname=mysqli_real_escape_string($conn, $_POST['companyname']);
	$headofficecity=mysqli_real_escape_string($conn, $_POST['headofficecity']);
	$contactno=mysqli_real_escape_string($conn, $_POST['contactno']);
	$website=mysqli_real_escape_string($conn, $_POST['website']);
	$companytype=mysqli_real_escape_string($conn, $_POST['companytype']);
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$password=mysqli_real_escape_string($conn, $_POST['password']);
	
	//Encrypt password
	$password=base64_encode(strrev(md5($password)));

	$sql="SELECT email FROM company WHERE email='$email'";
	$result=$conn ->query($sql);

		if($result->num_rows == 0){

		$sql="INSERT INTO company(companyname, headofficecity, contactno, website, companytype, email, password) VALUES('$companyname', '$headofficecity','$contactno', '$website', '$companytype', '$email', '$password')";
		
		if($conn ->query($sql)===TRUE){
			$_SESSION['registerCompleted']=true;
			header("Location: company-login.php"); //header is used to redirect
			exit();
			
		}else{echo "Error ".$sql."<br>".$conn->error;}
		$conn ->close(); //close connection
		}else{
		$_SESSION['registerError']=true;
		header("Location: company-register.php");
		exit();
	}

}else{ //if user do not put anything on the form redirect them to
	header("Location: company-register.php");
	exit();
}

?>