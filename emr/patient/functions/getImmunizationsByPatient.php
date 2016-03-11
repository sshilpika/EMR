<?php

  function getImmunizationsByPatient($patientId){  
  
    global $pdo;

    try
    {    
      $sql = "SELECT 
                patient.EntryDate, imu.Value 
              FROM 
                immunizations imu, PatientsImmunizations patient 
              WHERE 
                patient.P_SSN = '$patientId' 
              AND 
                imu.Id = patient.ImmunizationId
              ORDER BY
                patient.EntryDate DESC";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients Allergies: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }



  function getLastUpdatedTimeImmunization($patientId){  
   
    global $pdo;

    try
    {    
      $sql = "SELECT 
                max(EntryDate) AS 'LastUpdated'
              FROM 
                PatientsImmunizations 
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