<?php

  function getNotesDates($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                EntryDate
              FROM 
                Notes
              WHERE 
                P_SSN = '$patientId'
              ORDER BY 
                EntryDate DESC";   
      
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching data: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>