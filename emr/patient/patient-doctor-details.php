
<!-- Show the latest update time -->
<?php   

        
	include_once 'functions/getPatientPhysicianDetails.php';

?>

<br/><br/>

<!-- Show the list of allergies -->
<table>
  
<?php

    $result = getPatientPhysicianDetails($ssn);            
    while ($row = $result->fetch()){
?>     
		<tr style="list-style-type:square">
		
		<td>
		 <?php echo 'Dr.'.$row['First_name'].' '.$row['Last_Name']; ?>
			<br/><br/>
		</td>
		<td></td>
		</tr>
		<tr>
		<td>Address :<br/><br/></td>
		<td>
		 <?php echo $row['D_Office_Address'].', '.$row['D_Office_City'].', '.$row['D_Office_State']; ?>
			<br/><br/>
		</td>
		</tr>
		<tr>
		<td>Phone :<br/><br/></td>
		<td>
		 <?php echo $row['D_Office_Phone']; ?>
			<br/><br/>
		</td>
		</tr>
<?php
    }
?>
   

</table>
    

