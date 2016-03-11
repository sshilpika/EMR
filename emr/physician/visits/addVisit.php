<?php
  
  if(isset($_POST['visitId'])){

    $visitId = $_POST['visitId'];  
    $docName = $_POST['docName'];
    $billNum = $_POST['billNum'];
    $comments = $_POST['comments'];
    $complaint = $_POST['complaint'];   

    $patientId = $_POST['ssn'];
  
    $diagnosisList = $_POST['diagnosisList'];
    $diagnosisList = explode(',', $diagnosisList);

    $pharmacistId = $_POST['pharmacistId'];

    $medInfo = $_POST['medInfo'];
    $medicineList = explode(',', $medInfo);    

    include 'functions/addNewVisit.php';      
    
    try{      
      $dSSN = getDSSN($docName);
      $result = addToVisit($visitId, $dSSN, $billNum, $comments, $complaint);
      $result = addToHasVisit($patientId, $visitId);
      $result = addToResult($visitId, $diagnosisList);

      if(count($medicineList) > 1){
        $result = addPrescription($visitId, $pharmacistId, $medicineList);        
      }
      
      echo $result;
      //echo "adasd";
	  }catch(Exception $e){
       echo $e->getMessage();
  	}   	   
  }


  function getDSSN($docName){
    try{
        $result = getDoctorSSN($docName);
        $row = $result->fetch();
        return $row['SSN'];                  
    }catch(Exception $e){
       return '';
    }
  }

?>