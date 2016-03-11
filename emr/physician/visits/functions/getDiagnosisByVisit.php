<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getDiagnosisByVisit($visitId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Diagnosis_Category 
              FROM 
                Diagnosis 
              WHERE 
                Diagnosis_ID 
              IN 
              (
                SELECT 
                  Diagnosis_ID 
                FROM 
                  Result 
                WHERE 
                  Visit_ID = '$visitId'
              )";   
      
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