<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getDiagnosisList($visitId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Diagnosis_Category 
              FROM 
                Diagnosis";   
      
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