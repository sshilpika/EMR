<?php
  if(isset($_GET['ssn'])){
    $ssn = $_GET['ssn'];    
    $dateValue = $_GET['dateValue'];
    
    $arr = array();

    try{
      if($dateValue != ''){
        include 'functions/getVisitByDate.php';
        $result = getVisitByDate($dateValue);
        $row = $result->fetch();            
        //echo $row['Visit_ID'].' --LINEBRAKE-- '.$row['First_Name'].' '.$row['Last_Name'].' --LINEBRAKE-- '.$row['Bill_Num'].' --LINEBRAKE-- '.$row['CommentsSuggestions'].' --LINEBRAKE-- '.$row['Complaint'];
        
        $arr['visitId'] = $row['Visit_ID'];
        $arr['firstName'] = $row['First_Name'];
        $arr['lastName'] = $row['Last_Name'];
        $arr['billNum'] = $row['Bill_Num'];
        $arr['comment'] = $row['CommentsSuggestions'];
        $arr['complaint'] = $row['Complaint'];

        echo json_encode($arr);        
      }
    }catch(Exception $e){
       echo $e->getMessage();
    } 
  }
?>