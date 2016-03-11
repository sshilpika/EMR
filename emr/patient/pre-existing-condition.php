

<!-- Show the latest update time -->
<?php    
    include_once 'functions/getPreConditionsByPatient.php';    
    
    $result = getLastUpdatedTime($ssn);            
    while ($row = $result->fetch()){
?>
    <label>
        <i>Last Updated :  <?php echo $row['LastUpdated'] ?></i>        
    </label>
<?php
    }
?>


<!-- Show the list of pre-existing conditions -->
    <ul style="list-style-type:square">
<?php
    $result = getPreConditionsByPatient($ssn);            
    while ($row = $result->fetch()){
?>    
        <li>
            <?php echo $row['Value']; ?>    
           
        </li>
        <br/>
<?php
    }
?>
    </ul>


    

