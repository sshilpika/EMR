<?php

  function getPharmacistByPharmacistDetails($username){  
    global $pdo;

    try
    {    
      $sql = "Select d.SSN from pharmacist d where d.username='$username'";           
      $result = $pdo->query($sql);  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching pharmacist list: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }
	$row = $result->fetch();
    return $row['SSN'];
  }

?>