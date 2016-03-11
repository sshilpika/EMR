<?php

  function getMedicationsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                med.EntryDate , med.MedicineName
              FROM 
                Medications med
              WHERE 
                med.P_SSN = '$patientId' 
              
              ORDER BY
                med.EntryDate DESC";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients Pre-existing Conditions: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }



  function getLastUpdatedTimeMedication($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                max(EntryDate) AS 'LastUpdated'
              FROM 
                Medications 
              WHERE P_SSN = '$patientId'";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching Last Updated Time: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>