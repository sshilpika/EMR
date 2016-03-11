
<!-- Show the latest update time -->
<?php   

        
	include_once 'functions/getMedicationsByPatient.php';
    $result = getLastUpdatedTimeMedication($ssn);            
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
   <tr><th>Medicine<br/><br/></th>
   <th>Prescribed Date<br/><br/></th></tr>
<?php

    $result = getMedicationsByPatient($ssn);            
    while ($row = $result->fetch()){
?>     
		<tr style="list-style-type:square">
		<td>
		 <?php echo $row['MedicineName']; ?>
			<br/><br/>
		</td>
		<td>
		 <?php echo $row['EntryDate']; ?>
			<br/><br/>
		</td>
		</tr>
<?php
    }
?>
   

</table>
    

