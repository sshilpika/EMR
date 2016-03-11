<?php

  function addPreConditionByPatient($patientId, $newValue){  
    
    //global $pdo;
    include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

    try
    {    
      $sql = "INSERT INTO 
                PatientsPreConditions(P_SSN, PreConditionId, EntryDate) 
              VALUES(
                :patientId, (SELECT Id FROM PreExistingConditions WHERE Value = :newValue), now()
              )";

      $stmt = $pdo->prepare($sql);              
      $stmt->bindValue(':patientId', $patientId);
      $stmt->bindValue(':newValue', $newValue);
      //return "donno";
      $stmt->execute();
      return "Item inserted successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error while insertion: '.$e->getMessage();      
      //include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }      
  }

?>