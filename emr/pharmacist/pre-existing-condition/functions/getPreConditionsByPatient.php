<?php

  function getPreConditionsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                patient.EntryDate, pre.Value 
              FROM 
                PreExistingConditions pre, PatientsPreConditions patient 
              WHERE 
                patient.P_SSN = '$patientId' 
              AND 
                pre.Id = patient.PreConditionId
              ORDER BY
                patient.EntryDate DESC";   
              
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



  /*function getLastUpdatedTime($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                max(EntryDate) AS 'LastUpdated'
              FROM 
                PatientsPreConditions 
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
  }*/

?>