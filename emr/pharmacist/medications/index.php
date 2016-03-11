
<html>
<head>
    <title></title>
    
    <script src="js/jquery-1.11.1.min.js"></script>
        
</head>


<body>
<!-- Show the latest update time -->
<?php    
    //include 'functions/getPreConditionsByPatient.php';    
    include_once 'functions/getLastUpdateTime.php';    
    
    //$result = getLastUpdatedTime($ssn);
    $tableName = 'Medications';            
    $result = getLastUpdatedTime($ssn, $tableName);            
    while ($row = $result->fetch()){
?>
    <label>
        <i>Last Updated :   <?php 
                                $row['LastUpdated'] = ($row['LastUpdated'] == '') ? 'No record found' : $row['LastUpdated']; 
                                echo $row['LastUpdated'] ;
                            ?>
        </i>        
    </label>
<?php
    }
?>


<!-- Show the list of pre-existing conditions -->
    <ul style="list-style-type:square">
<?php
    include_once 'functions/getMedicationsByPatient.php';    
    $result = getMedicationsByPatient($ssn);            
    while ($row = $result->fetch()){
?>    
        <li>
            <?php echo $row['MedicineName']; ?>    
           
        </li>
        <br/>
<?php
    }
?>
    </ul>




</body>
</html>
