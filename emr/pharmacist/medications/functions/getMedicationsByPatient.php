<?php

  function getMedicationsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                meds.MedicineName
              FROM 
                Medications meds
              WHERE 
                meds.P_SSN = '$patientId'               
              ORDER BY
                meds.EntryDate DESC";   
      
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching medications data: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>