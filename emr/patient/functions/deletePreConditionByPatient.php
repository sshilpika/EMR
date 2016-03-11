<?php

  function deletePreConditionByPatient($patientId, $value){  
    
    //global $pdo;
    include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

    try
    {    
      $sql = "DELETE FROM 
                PatientsPreConditions                 
              WHERE 
                P_SSN = :patientId
              AND
                PreConditionId = (SELECT Id FROM PreExistingConditions WHERE Value = :value)";              

      $stmt = $pdo->prepare($sql);              
      $stmt->bindValue(':patientId', $patientId);
      $stmt->bindValue(':value', $value);      
      $stmt->execute();
      return "Item removed successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error while removing item: '.$e->getMessage();      
      //include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }      
  }

?>