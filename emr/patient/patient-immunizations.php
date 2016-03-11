
<html>
<head>
    <title></title>
    
   
       
</head>


<body> 
<!-- Show the latest update time -->
<?php   

    include 'functions/getImmunizationsByPatient.php';    
   
    $result = getLastUpdatedTimeImmunization($ssn);            
    while ($row = $result->fetch()){
?>
    <label>
        <i>Last Updated :  <?php echo $row['LastUpdated'] ?></i>        
    </label>
<?php
    }
?>
<br/><br/>

<!-- Show the list of immunizations -->
<table>
    
<?php
    $result = getImmunizationsByPatient($ssn);            
    while ($row = $result->fetch()){
?>    
<tr>
        <td>
            <?php echo $row['Value']; ?>  <br/> <br/>
           
        </td>
		<td>
            <?php echo $row['EntryDate']; ?>   <br/> <br/>
           
        </td>
</tr>
<?php
    }
?>
    
</table>

    

</body>
</html>
