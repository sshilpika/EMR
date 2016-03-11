<?php

  function getDemographicsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                First_Name, Last_Name, Gender, Birth_Date, SSN, Home_Address, City, State, ZipCode, Home_Phone 
              FROM 
                Person 
              WHERE 
                SSN = '$patientId';";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients demographics: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>