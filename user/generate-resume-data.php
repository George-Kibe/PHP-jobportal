<?php
session_start(); //start session

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
if(isset($_POST)){
	
	require_once("../vendor/autoload.php");
	$templateLocation="resources/resume-template/resume-template-1.docx";
	$filename="MyResume.docx";
	$templateProcessor= new \PhpOffice\PhpWord\TemplateProcessor($templateLocation);

	$templateProcessor ->setValue('Name', $_POST['name']);
	$templateProcessor ->setValue('Address', $_POST['address']);
	$templateProcessor ->setValue('Phone', $_POST['phone']);
	$templateProcessor ->setValue('Email', $_POST['email']);

	$countExperience="$_POST[experienceNo]";//"$_POST[experienceNo]";
	echo $countExperience;

	$templateProcessor->cloneRow('companyName', $countExperience);
	$templateProcessor->cloneRow('userId', 2);
	/*$values = [
    ['companyName' => '$_POST[companyName][$i -1]', 'location' => '$_POST[location][$i -1];', 'position' => '$_POST[location][$i -1]', 'position' => '$_POST[position][$i -1]', 'timeperiod' => '$_POST[timeperiod][$i -1]', 'experience' => '$_POST[experience][$i -1]' ] ];
	$templateProcessor->cloneRowAndSetValues('companyName', $values);*/

	for($i=1; $i<=$countExperience; $i++){
		$selector="companyName#".$i;
		$value=$_POST['companyName'][$i -1];
		$templateProcessor ->setValue($selector, $value);

		$selector="location#".$i;
		$value=$_POST['location'][$i -1];
		$templateProcessor ->setValue($selector, $value);

		$selector="position#".$i;
		$value=$_POST['position'][$i -1];
		$templateProcessor ->setValue($selector, $value);

		$selector="timeperiod#".$i;
		$value=$_POST['timeperiod'][$i -1];
		$templateProcessor ->setValue($selector, $value);

		$selector="experience#".$i;
		$value=$_POST['experience'][$i -1];
		$templateProcessor ->setValue($selector, $value);
	}
	//file downloads when you click on generate
$templateProcessor ->saveAs($filename);
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Description: attachment, filename='.$filename);
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0 pre-check=0');
header('Pragma:public');
header('Content-Length:'.filesize($filename));
flush();
readfile($filename);
unlink($filename);

}
?>
















