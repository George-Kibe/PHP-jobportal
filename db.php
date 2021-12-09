<?php //This file is used to connect to the database
$servername="localhost";
$username="root";
$password="";
$dbname="jobportal";

//create connection new mysqli with four parameters
$conn=new mysqli($servername, $username, $password, $dbname);

//check connection
if($conn->connect_error){die("Connection Failed:".$conn->connect_error);};
?>