<?php

  function getDemographicsByPatient($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                person.First_Name, person.Last_Name, person.Gender, person.Birth_Date, person.SSN, person.Home_Address, person.City, person.State, person.ZipCode, person.Home_Phone,patient1.Image,patient1.Current_status
              FROM 
                Person person, patient patient1
              WHERE 
				person.SSN = patient1.SSN and
                person.SSN = '$patientId';";   
              
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