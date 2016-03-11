<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function updateNoteByPatient($patientId, $newValue, $entryDate){  
    
    global $pdo;
    //include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

    try
    {    
      $sql = "UPDATE 
                Notes 
              SET 
                Comments = :newValue,
                EntryDate = :entryDate
              WHERE 
                P_SSN = :patientId
              AND 
                EntryDate = :entryDate";

      $stmt = $pdo->prepare($sql);        
      $stmt->bindValue(':newValue', $newValue);
      $stmt->bindValue(':patientId', $patientId);      
      $stmt->bindValue(':entryDate', $entryDate);      
      //return "donno";
      $stmt->execute();
      return "Records updated successfully!";                 
      //return $sql;
    }
    catch (PDOException $e)
    {
      $error = 'Error while updating record: '.$e->getMessage();      
      //include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }      
  }

?>