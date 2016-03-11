<?php

  function getAllergyList(){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Value
              FROM 
                Allergies               
              ORDER BY
                Value";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching Allergies: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }
  
?>