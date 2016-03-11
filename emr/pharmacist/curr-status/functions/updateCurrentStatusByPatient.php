<?php

  function updateCurrentStatusByPatient($patientId, $newValue){  
    
    //global $pdo;
    include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

    try
    {    
      $sql = "UPDATE 
                Patient 
              SET 
                Current_Status = :newValue
              WHERE 
                SSN = :patientId";

      $stmt = $pdo->prepare($sql);        
      $stmt->bindValue(':newValue', $newValue);
      $stmt->bindValue(':patientId', $patientId);      
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