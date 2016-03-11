<?php

  function getPatientsByPatientDetails($patientUname){  
    
    global $pdo;

    try
    {    
      $sql = "Select * from patient where .$patientUname."');";          
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients list: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>