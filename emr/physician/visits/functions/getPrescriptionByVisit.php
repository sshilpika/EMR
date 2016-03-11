<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getPrescriptionByVisit($visitId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                Mname, Medicine_Quantity 
              FROM 
                Medicine med, Prescribed_Meds pres 
              WHERE 
                med.Minventory_ID = pres.Minventory_ID 
              AND 
                Prescription_ID = (
                  SELECT 
                    Prescription_ID 
                  FROM 
                    Prescription 
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