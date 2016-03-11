<?php

  function getPatientByPatientDetails($username){  
    
    global $pdo;

    try
    {    
      $sql = "CALL findPatientByPatientDetails('".$username."');";           
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients list: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>