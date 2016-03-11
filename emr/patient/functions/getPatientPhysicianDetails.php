<?php

  function getPatientPhysicianDetails($patientId){  
    
    global $pdo;

    try
    {    
      $sql = "SELECT 
                p1.First_name , p1.Last_Name, d.D_Office_Address,d.D_Office_City,d.D_Office_State,d.D_Office_Phone
              FROM 
                Patient p, person p1, Doctor d
              WHERE 
			  p.D_SSN = p1.SSN and
			  p.D_SSN = d.SSN and
                p.SSN = '$patientId'";   
              
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching patients Pre-existing Conditions: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }


?>