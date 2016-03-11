<?php

  function getPhysicianByPhysicianDetails($username){  
    
    global $pdo;

    try
    {    
      $sql = "Select SSN from doctor where username='".$username."');";           
      $result = $pdo->query($sql);            
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching doctor list: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return null;
    }

    return $result;
  }

?>