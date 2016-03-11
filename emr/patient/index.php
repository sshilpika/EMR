<?php
	
	include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';
	include 'functions/getPatientByPatientDetails.php';
	
	$result = getPatientByPatientDetails($username);

	/*while ($row = $result->fetch()){
		echo $row['SSN'].' '.$row['First_Name'];
		echo '<br/>';
	}*/
	$row = $result->fetch();
	//include '/patient/patient-info.php';	
	header('Location: ' . '/emr/patient/patient-info.php?SSN='.$row['SSN']);
	//include 'patient-info.php';
?>
