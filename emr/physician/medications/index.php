
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
        var oldValue="";

        function popUpMedication(editBtn){
            document.getElementById('light4').style.display='block';
            document.getElementById('fade4').style.display='block';
            
            var selectedLabel = editBtn.parentNode.textContent.split("\n")[1].trim();
            oldValue = selectedLabel;

            document.getElementById('txtArea4').textContent = oldValue;            
        }

        function updateMedication(){
            var newValue = document.getElementById('txtArea4').value.trim();            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'medications/updateMedication.php',
                data: { ssn: ssn, oldValue: oldValue, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel4').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel4').textContent = data;
                }  
            });            
        }

        function deleteMedication(deleteBtn){
            var selectedLabel = deleteBtn.parentNode.textContent.split("\n")[1].trim();
            if (confirm('Are you sure you want to delete this item?')) {
                var ssn = <?php echo $ssn; ?>;            
                $.ajax({
                    type: "POST",
                    url: 'medications/deleteMedication.php',
                    data: { ssn: ssn, value: selectedLabel},
                    success: function(data){
                        alert(data);
                    },
                    error: function(data){                    
                        alert(data);
                    }  
                });
                location.reload();
            } else {
                // Do nothing!
            }
        }

        function addNewMedication(addNewItem){
            document.getElementById('light4').style.display='block';
            document.getElementById('fade4').style.display='block';
                      
            document.getElementById('btnSave4').textContent='Add';
            document.getElementById('btnSave4').onclick = function(){ addMedication(document.getElementById('btnSave4')); };
        }

        function addMedication(addBtn){            
            var newValue = document.getElementById('txtArea4').value.trim();            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'medications/addMedication.php',
                data: { ssn: ssn, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel4').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel4').textContent = data;
                }  
            });
        }
        
        function closeMedication(){
            document.getElementById('light4').style.display='none';
            document.getElementById('fade4').style.display='none';
            location.reload();
        }

    </script>        
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
            <button onclick="popUpMedication(this)">Edit</button>
            <button onclick="deleteMedication(this)">Delete</button>
        </li>
        <br/>
<?php
    }
?>
    </ul>


<!-- Add new item Button -->
    <p><button onclick="addNewMedication(this)">Add New Item</button></p>




<!-- Pop-Up screen -->
    <?php include 'functions/getPreConditionList.php'; ?>    

    <div id="light4" class="white_content">
        Medication: 
        <textarea id="txtArea4" rows="1"></textarea>            
        <button id="btnSave4" onclick="updateMedication()">Save</button>

        <br/>
        <br/>
        <!--<a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'">Close</a>-->
        <a href = "javascript:void(0)" onclick = "closeMedication()">Close</a>

        <br/>
        <br/>
        <i><div id="bottomLabel4"></div></i>
    </div>

    <div id="fade4" class="black_overlay"></div>

<!--******************************************-->
    

</body>
</html>
