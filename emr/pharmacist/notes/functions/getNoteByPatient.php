<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getNoteByPatient($patientId, $dateValue){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Comments
              FROM 
                Notes
              WHERE 
                P_SSN = '$patientId'
              AND 
                EntryDate = '$dateValue'";   
        
      $result = $pdo->query($sql);                  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching note: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }
    
    return $result;
  }

?>