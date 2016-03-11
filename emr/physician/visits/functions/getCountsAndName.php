<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getVisitCount(){  
    
    global $pdo;

    try
    {    
        $sql = "SELECT 
                  COUNT(*) AS 'Count'
                FROM 
                  Visit";

      $result = $pdo->query($sql);                  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching count: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }
    
    return $result;
  }


  function getBillCount(){  
    
    global $pdo;

    try
    {    
        $sql = "SELECT 
                  COUNT(*) AS 'Count'
                FROM 
                  Bill";

      $result = $pdo->query($sql);                  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching count: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }
    
    return $result;
  }



  function getPhysicianName($ssn){  
    
    global $pdo;

    try
    {    
        $sql = "SELECT 
                  CONCAT(First_Name, ' ', Last_Name) AS 'Name'
                FROM 
                  Person person
                WHERE                   
                  SSN = (
                    SELECT 
                      D_SSN 
                    FROM 
                      Patient 
                    WHERE 
                      SSN = '$ssn'
                )";

      $result = $pdo->query($sql);                  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching name: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }
    
    return $result;
  }

?>