<?php
	//$row = $result->fetch()
	
	$ssn = $_GET['SSN'];
	
	include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/db.inc.php';
    include $_SERVER['DOCUMENT_ROOT'].'/emr/logout.inc.html.php'; 
?>

<html>
<head>
<title>Patient Info</title>
<style>
body {
   // background: url("img/background_img.jpg") !important;
}
</style>
<link href="tab-content/template1/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>

<link href="css/tabs.css" rel="stylesheet" type="text/css" />
<script src="js/tabs.js" type="text/javascript"></script>

</head>

<body style="background:#F6F9FC; font-family:Arial;">

<div align="center">
    <br/>
    <br/>    
    <label id="labelTop">Patient's Name: </label>
    <b><label id="pName"></label></b>
</div>


<div style="width: 80%; margin: 0 auto; padding: 60px 0 40px;">
	<ul class="tabs" data-persist="true">
    <li class="selected"><a href="#view1">Demographics</a></li>
    <li><a href="#view2">Pre-existing Conditions</a></li>
    <li><a href="#view3">Allergies</a></li>
    <li><a href="#view4">Medications</a></li>
    <li><a href="#view5">Immunizations</a></li>
    <!--<li><a href="#view6">Current Status</a></li>-->
    <li><a href="#view7">Visits</a></li>
    <!--<li><a href="#view8">Prescriptions</a></li>-->
    <li><a href="#view9">Contact Details</a></li>
</ul>
<div class="tabcontents">
    <div id="view1">
        <?php include_once 'patient-demographics.php'; ?>                      
    </div>
    
    <div id="view2">
	<?php //include 'patient-allergies.php'; ?>
        <?php include_once 'pre-existing-condition.php'; ?>
    </div>

    <div id="view3">
	
        <?php include_once 'patient-allergies.php'; ?>
    </div>
    <div id="view4">
		<?php include 'patient-medication.php'; ?>
        
    </div>
    <div id="view5">
        <?php include 'patient-immunizations.php'; ?>
    </div>
    <!--<div id="view6">
        content 6
    </div>-->
    
    <div id="view7">
        
		<?php include 'patient-prescriptions.php'; ?>

       <!-- <div id="widnow">
            <div id="title_bar">
                <div id="button" onclick="collapse()">-</div>
            </div>
            <div id="box">
            </div>
        </div>-->
    </div>
    
    <!--<div id="view8">
        content 8
    </div>-->
    <div id="view9">
        <?php include 'patient-doctor-details.php'; ?>
    </div>
</div>

</div>






</body>

</html>