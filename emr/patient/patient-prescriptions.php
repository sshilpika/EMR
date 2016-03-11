<head><script src="js/jquery-1.11.1.min.js"></script></script>
<script> 
 $(document).ready(function () {
 $('.panel-item').hide();
 $('.panel-item-1').hide();
	 $('.outer-row').on('click', function () {
			
			var $t = $(this).next('.panel-item').stop(true).slideToggle();
			var $t1 = $(this).next('tr.panel-item').next().stop(true).slideToggle();
			return false;
		});
		
	});
	
</script> 
<style> 
td.inner-header
{
padding-top: 5px;
padding-bottom: 4px;
font-weight: bold;
text-align: left;
background-color: #A7C3FA;
width: 400px !important;
}
#visits{
border: 1px solid black;
}
td.panel-row-items{
background-color: #F6F9FC;
}
.wrap-table,.wrap-header{
border: 1px solid black;
padding-top: 5px;
padding-bottom: 4px;
width: 400px !important;
background-color: #A7C3FA;
text-align: center !important;
}
</style>
</head>
<!-- Show the latest update time -->
<?php   

        
	include_once 'functions/getPrescriptionsByPatient.php';
   
?>

<br/><br/>
<!-- Show the list of allergies -->
<i>Click the rows for more information</i>
<table id="visits">
<tr id="wrap-table"><th class="wrap-header">Visited Date</th>
		<th class="wrap-header">Diagnosis</th>
		<th class="wrap-header">Prescription ID</th>
		<th class="wrap-header">Medicine Prescribed</th>
		<th class="wrap-header">Pharmacy Address</th>
		<th class="wrap-header">Bill Number</th>
		</tr>   <!--<tr><th align="center">Date Visited<br/><br/></th>
   <th align="center">Diagnosis<br/><br/></th></tr>-->
<?php

    $result = getPrescriptionsByPatient($ssn);            
    while ($row = $result->fetch()){
?>    <!--<table class="outer-table">-->
		<tr class="outer-row">
		<td class="panel-row-items">
		 <?php echo substr($row['Date_Time'],0,11); ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['Diagnosis_Category']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['prescription_ID']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['Mname']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['P_Office_Address'].','.$row['P_Office_City'].','.$row['P_Office_State']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['Bill_Num']; ?>
			<br/><br/>
		</td>
		
		</tr>
		<!--</table>-->
		<!--<table class="panel">-->
		<tr class="panel-item"><td class="inner-header">Amount</td>
		<td class="inner-header">Bill Date</td>
		<td class="inner-header">Due Date</td>
		<td class="inner-header">Payment Date</td>
		<td class="inner-header">Payment Status</td>
		<td></td>
		</tr>
		<tr class="panel-item-1">
		<td class="panel-row-items">
		 <?php echo $row['Amount']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['Bill_Date']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['Due_Date']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['payment_Date']; ?>
			<br/><br/>
		</td>
		<td class="panel-row-items">
		 <?php echo $row['payment_Status']; ?>
			<br/><br/>
		</td>
		<td></td>
		</tr>
		
<?php
    }
?>
</table>   


    

