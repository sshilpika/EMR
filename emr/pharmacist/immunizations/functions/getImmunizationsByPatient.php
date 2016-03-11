<?php

  function getImmunizationsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                patient.EntryDate, immu.Value 
              FROM 
                Immunizations immu, PatientsImmunizations patient 
              WHERE 
                patient.P_SSN = '$patientId' 
              AND 
                immu.Id = patient.ImmunizationId
              ORDER BY
                patient.EntryDate DESC";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients Immunizations: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>