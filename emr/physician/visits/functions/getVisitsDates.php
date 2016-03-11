<?php

  function getVisitsDates($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Date_Time
              FROM 
                Visit
              WHERE 
                Visit_ID 
              IN 
                (
                  SELECT 
                    Visit_ID 
                  FROM 
                    Has_Visits 
                  WHERE 
                    P_SSN = '$patientId'
                )              
              ORDER BY 
                Date_Time DESC";   
      
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