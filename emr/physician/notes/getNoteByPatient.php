<?php
  if(isset($_GET['ssn'])){
    $ssn = $_GET['ssn'];    
    $dateValue = $_GET['dateValue'];
    //echo "$ssn";
    try{
      if($dateValue != ''){
        include 'functions/getNoteByPatient.php';
        $result = getNoteByPatient($ssn, $dateValue);
        $row = $result->fetch();            
        if($row['Comments'] == '')  echo 'None';  
        else   echo $row['Comments'];
      }
    }catch(Exception $e){
       echo $e->getMessage();
    } 
  }
?>