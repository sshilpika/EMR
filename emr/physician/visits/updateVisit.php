<?php
  if(isset($_POST['ssn'])){
    $ssn = $_POST['ssn'];    
    $newValue = $_POST['newValue'];
    $entryDate = $_POST['entryDate'];
  
    try{
    	include 'functions/updateNoteByPatient.php';
      $result = updateNoteByPatient($ssn, $newValue, $entryDate);
      echo $result;
	}catch(Exception $e){
       echo $e->getMessage();
  	}   	   
  
  }

?>