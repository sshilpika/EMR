<?php
    include 'functions/getDemographicsByPatient.php';
    $result = getDemographicsByPatient($ssn);            
            
    while ($row = $result->fetch()){
?>      
        <script type="text/javascript">
            document.getElementById('pName').innerHTML = "<?php echo $row['First_Name']; ?>" + "  " + "<?php echo $row['Last_Name']; ?>";
        </script>

        <p><label>First Name: </label><label><b><?php echo $row['First_Name']; ?></b></label></p>             
        <p><label>Last Name: </label><label><b><?php echo $row['Last_Name']; ?></b></label></p>
        <p><label>Gender: </label><label><b><?php echo $row['Gender']; ?></b></label></p>
        <p><label>Birth Date: </label><label><b><?php echo $row['Birth_Date']; ?></b></label></p>
        <p><label>SSN: </label><label><b><?php echo $row['SSN']; ?></b></label></p>
        <p><label>Home Address: </label><label><b><?php echo $row['Home_Address']; ?></b></label></p>
        <p><label>City: </label><label><b><?php echo $row['City']; ?></b></label></p>
        <p><label>State: </label><label><b><?php echo $row['State']; ?></b></label></p>
        <p><label>Zip Code: </label><label><b><?php echo $row['ZipCode']; ?></b></label></p>
        <p><label>Home Phone: </label><label><b><?php echo $row['Home_Phone']; ?></b></label></p>
<?php 
    }
?>    