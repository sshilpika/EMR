<?php
  if(isset($_GET['visitId'])){
    $visitId = $_GET['visitId'];        
    
    $arr = array();

    try{
      if($visitId != ''){
        include 'functions/getPrescriptionByVisit.php';
        $result = getPrescriptionByVisit($visitId);
        while($row = $result->fetch()){
          array_push($arr, $row['Mname']);
          array_push($arr, $row['Medicine_Quantity']);
        }                    
        
        /*$arr['visitId'] = $row['Visit_ID'];
        $arr['firstName'] = $row['First_Name'];
        $arr['lastName'] = $row['Last_Name'];
        $arr['billNum'] = $row['Bill_Num'];
        $arr['comment'] = $row['CommentsSuggestions'];
        $arr['complaint'] = $row['Complaint'];*/
    
        echo json_encode($arr);        
      }
    }catch(Exception $e){
       echo $e->getMessage();
    } 
  }
?>