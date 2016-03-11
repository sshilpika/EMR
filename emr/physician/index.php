<?php
	
	include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';
	
	include 'functions/getPatientsByPhysician.php';
	include 'functions/getPhysicianByPhysicianDetails.php';
	$ssn = getPhysicianByPhysicianDetails($username);
	$result = getPatientsByPhysicianId($ssn);

	/*while ($row = $result->fetch()){
		echo $row['SSN'].' '.$row['First_Name'];
		echo '<br/>';
	}*/
	
	include 'patient-table.html';	
	
	//include 'patient-info.php';
?>
