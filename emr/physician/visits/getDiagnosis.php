<?php
  if(isset($_GET['visitId'])){
    $visitId = $_GET['visitId'];        
    
    $arr = array();

    try{
      if($visitId != ''){
        include 'functions/getDiagnosisByVisit.php';
        $result = getDiagnosisByVisit($visitId);
        while ($row = $result->fetch()){
          array_push($arr, $row['Diagnosis_Category']);
        }           
      }      
      echo json_encode($arr);
    }catch(Exception $e){
       echo $e->getMessage();
    }     
  }
  
?>