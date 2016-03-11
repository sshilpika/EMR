<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';

  function getVisitByDate($dateValue){  
    
    global $pdo;

    try
    {    
        $sql = "SELECT 
                  Visit_ID, physician.First_Name, physician.Last_Name, Bill_Num, CommentsSuggestions, Complaint
                FROM 
                  Visit visit, Person physician
                WHERE                 
                  Date_Time = '$dateValue'
                AND 
                  visit.D_SSN = physician.SSN";

      $result = $pdo->query($sql);                  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching visit: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }
    
    return $result;
  }

?>