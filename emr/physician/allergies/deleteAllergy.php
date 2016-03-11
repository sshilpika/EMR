<?php
  if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];
    $value = $_POST['value'];    

    try{
      include 'functions/deleteAllergyByPatient.php';
      $result = deleteAllergyByPatient($ssn, $value);
      echo $result;    	
	 }catch(Exception $e){
       echo $e->getMessage();
  	} 	   
  
  }

?>