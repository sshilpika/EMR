<?php
	
	include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';
	
	include 'functions/getPatientsByPharmacist.php';
	include 'functions/getPharmacistByPharmacistDetails.php';
	$ssn = getPharmacistByPharmacistDetails($username);
	$result = getPatientsByPharmacistId($ssn);

	/*while ($row = $result->fetch()){
		echo $row['SSN'].' '.$row['First_Name'];
		echo '<br/>';
	}*/
	
	include 'patient-table.html';	
	
	//include 'patient-info.php';
?>
