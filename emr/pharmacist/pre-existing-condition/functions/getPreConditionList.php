<?php

  function getPreConditionList(){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Value
              FROM 
                PreExistingConditions               
              ORDER BY
                Value";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching Pre-existing Conditions: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }
  
?>