<?php

  function updatePreConditionByPatient($patientId, $oldValue, $newValue){  
    
    //global $pdo;
    include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

    try
    {    
      $sql = "UPDATE 
                PatientsPreConditions 
              SET 
                PreConditionId = (SELECT Id FROM PreExistingConditions WHERE Value = :newValue) 
              WHERE 
                P_SSN = :patientId
              AND 
                PreConditionId 
              IN 
                (SELECT Id FROM PreExistingConditions WHERE Value = :oldValue)";

      $stmt = $pdo->prepare($sql);        
      $stmt->bindValue(':newValue', $newValue);
      $stmt->bindValue(':patientId', $patientId);
      $stmt->bindValue(':oldValue', $oldValue);
      //return "donno";
      $stmt->execute();
      return "Records updated successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error while updating record: '.$e->getMessage();      
      //include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }      
  }

?>