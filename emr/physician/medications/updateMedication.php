<?php
  if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
    $oldValue = $_POST['oldValue'];
    $newValue = $_POST['newValue'];
  
    try{
    	if($newValue != 'Select an Item' && $newValue != $oldValue){
	      include 'functions/updateMedicationByPatient.php';
	      $result = updateMedicationByPatient($ssn, $oldValue, $newValue);
	      echo $result;
	    }
	}catch(Exception $e){
       echo $e->getMessage();
  	}   	   
  
  }

?>