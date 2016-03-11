
<!-- Show the latest update time -->
<?php   

        
	include_once 'functions/getAllergiesByPatient.php';
    $result = getLastUpdatedTimeAllergy($ssn);            
    while ($row = $result->fetch()){
?>
    <label>
        <i>Last Updated :  <?php echo $row['LastUpdated'] ?></i>        
    </label>
<?php
    }
?>

<br/><br/>
<!-- Show the list of allergies -->
<table>
   
<?php

    $result = getAllergiesByPatient($ssn);            
    while ($row = $result->fetch()){
?>     
		<tr style="list-style-type:square">
		<td>
		 <?php echo $row['Value']; ?>
			<br/><br/>
		</td>
		
		</tr>
<?php
    }
?>
   

</table>
    

