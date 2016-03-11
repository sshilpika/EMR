<?php

  function getAllergiesByPatient($patientId){  

    global $pdo;

    try
    {    
      $sql = "SELECT 
                patient.EntryDate, ale.Value 
              FROM 
                allergies ale, PatientsAllergies patient 
              WHERE 
                patient.P_SSN = '$patientId' 
              AND 
                ale.Id = patient.AllergyId
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



  function getLastUpdatedTimeAllergy($patientId){  
   
    global $pdo;

    try
    {    
      $sql = "SELECT 
                max(EntryDate) AS 'LastUpdated'
              FROM 
                PatientsAllergies 
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