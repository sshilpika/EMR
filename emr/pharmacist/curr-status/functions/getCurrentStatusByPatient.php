<?php

  function getCurrentStatusByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                patient.Current_Status
              FROM 
                Patient patient
              WHERE 
                patient.SSN = '$patientId'";   
      
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching current status: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>