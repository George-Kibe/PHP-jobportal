<?php
session_start();

if(empty($_SESSION['id_user'])){
	header("Location: ../index.php");
	exit();
}
require_once("../db.php");

if(isset($_POST)){
	$uploadOk=true;
	$folder_dir="../uploads/resume/";
	$base=basename($_FILES['resume']['name']);
	$resumeFileType=pathinfo($base, PATHINFO_EXTENSION);
	$file=uniqid(). ".".$resumeFileType;
	$filename=$folder_dir.$file; //where file will be saved

	if(file_exists($_FILES['resume']['tmp_name'])){ //tmp_name is the server temporary location
		if($resumeFileType=="pdf"){
			if(($_FILES['']['']) <50000){ //file size less than 5mbs
				move_uploaded_file(($_FILES['resume']['tmp_name']), $filename);
			}else{
				$_SESSION['uploadError']="File is too largefor a cv. Max Allowed is 5MB";
				$uploadOk=false;
			}
		}else{
			$_SESSION['uploadError']="File format not allowed. Only PDF is Allowed";
				$uploadOk=false;
		}

	}else{
		$_SESSION['uploadError']="Something Went Wrong. File not Uploaded. Try Again";
				$uploadOk=false;
	}

	if($uploadOk ==false){
		header("Location: resume-upload.php");
		exit();
	}
	$sql="SELECT * FROM users WHERE id_user='$_SESSION[id_user]'";
	$result=$conn ->query($sql);
	if($result ->num_rows >0){// check if user has already uploaded their resume
		$row=$result ->fetch_assoc();
		if($row['resume'] !=""){
			unlink("../upload/resume/".$row['resume']); //delete old file
		}
	}
	$sql="UPDATE users SET resume='$file' WHERE id_user='$_SESSION[id_user]'";
	if($conn ->query($sql)){
		header("Location: resume.php");
		exit();
	}else{
		echo "Error: ".$sql."<br>".$conn->error;
	}
	$conn ->close();
}












?>