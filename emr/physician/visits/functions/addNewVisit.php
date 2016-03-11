<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';
  
  function getDoctorSSN($docName){
    global $pdo;
    try
    {    
        $sql = "SELECT 
                  SSN
                FROM 
                  Person
                WHERE 
                  CONCAT(First_Name, ' ', Last_Name) = '$docName'";
      $result = $pdo->query($sql);                  
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching SSN: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }    
    return $result;    
  }



  function addToVisit($visitId, $dSSN, $billNum, $comments, $complaint){      
    global $pdo;  
    try
    {    
      $sql = "INSERT INTO 
                Visit(Visit_ID, D_SSN, Bill_Num, CommentsSuggestions, Complaint) 
              VALUES (
                :visitId, 
                :dSSN,
                :billNum,
                :comments,
                :complaint
              )";
      $stmt = $pdo->prepare($sql);              
      $stmt->bindValue(':visitId', $visitId);
      $stmt->bindValue(':dSSN', $dSSN);
      $stmt->bindValue(':billNum', $billNum);
      $stmt->bindValue(':comments', $comments);
      $stmt->bindValue(':complaint', $complaint);      
      $stmt->execute();
      return "Item inserted successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error while insertion: '.$e->getMessage();            
      return $error;
    }      
  }


  function addToHasVisit($patientId, $visitId){      
    global $pdo;  
    try
    {    
      $sql = "INSERT INTO 
                Has_Visits(P_SSN, Visit_ID) 
              VALUES (
                :pSSN,
                :visitId
              )";
      $stmt = $pdo->prepare($sql);              
      $stmt->bindValue(':pSSN', $patientId);
      $stmt->bindValue(':visitId', $visitId);      
      $stmt->execute();
      return "Item inserted successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error while insertion: '.$e->getMessage();            
      return $error;
    }      
  }


  function addToResult($visitId, $diagnosisArray){
    $out="";
    for ($c=0; $c<count($diagnosisArray)-1; $c++) {    
      $out = insertToResult($visitId, trim($diagnosisArray[$c]));
      //$out .= $diagnosisArray[$c];
    }  
    return $out;
  }
  function insertToResult($visitId, $diagnosisName){      
    global $pdo;  
    try
    {    
      $sql = "INSERT INTO 
                Result(Visit_ID, Diagnosis_ID) 
              VALUES (              
                :visitId,
                (SELECT Diagnosis_ID FROM Diagnosis WHERE Diagnosis_Category = '$diagnosisName')
              )";
      $stmt = $pdo->prepare($sql);                    
      $stmt->bindValue(':visitId', $visitId);         
      $stmt->execute();
      return "Item inserted successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'insertToResult: '.$e->getMessage();            
      return $error;
    }      
  }


  function addPrescription($visitId, $pharmacistId, $medicineList){      
    $rxId = createPrescriptionId();  

    $result = addToPrescription($rxId, $visitId, $pharmacistId);
    if(strstr($result, 'Error'))  { return $result; }

    for($c=0; $c<count($medicineList); $c+=2){
      $result = addToPrescribedMeds($rxId, $medicineList[$c], $medicineList[$c+1]);
      if(strstr($result, 'Error'))  { return $result; }
    }

    return $result;
  }

  function addToPrescribedMeds($rxId, $medName, $medQuan){          
    global $pdo;  
    try
    {    
      $sql = "INSERT INTO 
                Prescribed_Meds(Prescription_ID, Minventory_ID, Medicine_Quantity) 
              VALUES (
                :rxId,
                (SELECT Minventory_ID FROM Medicine WHERE Mname = '$medName'),
                :medQuan
              )";
      $stmt = $pdo->prepare($sql);                    
      $stmt->bindValue(':rxId', $rxId);         
      $stmt->bindValue(':medQuan', $medQuan);      
      $stmt->execute();
      return "Item inserted successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error addToPrescribedMeds: '.$e->getMessage();            
      return $error;
    }      
  }

  function addToPrescription($rxId, $visitId, $pharmacistId){          
    global $pdo;  
    try
    {    
      $sql = "INSERT INTO 
                Prescription(Prescription_ID, Visit_ID, PH_SSN) 
              VALUES (
                :rxId,
                :visitId,
                :pharmacistId
              )";
      $stmt = $pdo->prepare($sql);                    
      $stmt->bindValue(':rxId', $rxId);   
      $stmt->bindValue(':visitId', $visitId);   
      $stmt->bindValue(':pharmacistId', $pharmacistId);      
      $stmt->execute();
      return "Item inserted successfully!";            
    }
    catch (PDOException $e)
    {
      $error = 'Error while insertion: '.$e->getMessage();            
      return $error;
    }      
  }

  function createPrescriptionId(){
    global $pdo;
    try
    {    
        $sql = "SELECT 
                  CONCAT('Rx', count(*)) AS 'RxId'
                FROM 
                  Prescription";                
      $result = $pdo->query($sql);             
      $row = $result->fetch();
      return $row['RxId'];                             
    }
    catch (PDOException $e)
    {
      $error = 'Error while fetching count: ' . $e->getMessage();      
      include_once $_SERVER['DOCUMENT_ROOT'].'/emr/includes/error.html.php';
      return $error;
    }    
    return $result;    
  }
  
?>