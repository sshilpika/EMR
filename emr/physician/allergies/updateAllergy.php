<?php
  if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
    $oldValue = $_POST['oldValue'];
    $newValue = $_POST['newValue'];
  
    try{
    	if($newValue != 'Select an Item' && $newValue != $oldValue){
	      include 'functions/updateAllergyByPatient.php';
	      $result = updateAllergyByPatient($ssn, $oldValue, $newValue);
	      echo $result;
	    }
	}catch(Exception $e){
       echo $e->getMessage();
  	}   	   
  
  }

?>