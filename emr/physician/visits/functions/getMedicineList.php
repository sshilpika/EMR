<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getMedicineList($visitId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Mname 
              FROM 
                Medicine";   
      
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