<?php
  if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];    
    $newValue = $_POST['newValue'];
  
    try{
    	if($newValue != 'Select an Item'){
	      include 'functions/addPreConditionByPatient.php';
	      $result = addPreConditionByPatient($ssn, $newValue);
	      echo $result;
	    }
	}catch(Exception $e){
       echo $e->getMessage();
  	}   	   
  
  }

?>