
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
        var oldValue="";

        function popUpImmunization(editBtn){
            document.getElementById('light5').style.display='block';
            document.getElementById('fade5').style.display='block';
            
            var selectedLabel = editBtn.parentNode.textContent.split("\n")[1].trim();
            oldValue = selectedLabel;

            var dd = document.getElementById('immunizationList');
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].text === selectedLabel) {
                    dd.selectedIndex = i;                    
                    break;
                }
            }
            //alert(selectedItem);
        }

        function updateImmunization(){
            var newValue = document.getElementById('immunizationList').value;            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'immunizations/updateImmunization.php',
                data: { ssn: ssn, oldValue: oldValue, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel5').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel5').textContent = data;
                }  
            });            
        }

        function deleteImmunization(deleteBtn){
            var selectedLabel = deleteBtn.parentNode.textContent.split("\n")[1].trim();
            if (confirm('Are you sure you want to delete this item?')) {
                var ssn = <?php echo $ssn; ?>;            
                $.ajax({
                    type: "POST",
                    url: 'immunizations/deleteImmunization.php',
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

        function addNewImmunization(addNewItem){
            document.getElementById('light5').style.display='block';
            document.getElementById('fade5').style.display='block';
                      
            document.getElementById('btnSave5').textContent='Add';
            document.getElementById('btnSave5').onclick = function(){ addImmunization(document.getElementById('btnSave5')); };
        }

        function addImmunization(addBtn){            
            var newValue = document.getElementById('immunizationList').value;            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'immunizations/addImmunization.php',
                data: { ssn: ssn, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel5').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel5').textContent = data;
                }  
            });
        }
        
        function closeImmunization(){
            document.getElementById('light5').style.display='none';
            document.getElementById('fade5').style.display='none';
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
    $tableName = 'PatientsImmunizations';            
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
    include_once 'functions/getImmunizationsByPatient.php';    
    $result = getImmunizationsByPatient($ssn);            
    while ($row = $result->fetch()){
?>    
        <li>
            <?php echo $row['Value']; ?>    
            <button onclick="popUpImmunization(this)">Edit</button>
            <button onclick="deleteImmunization(this)">Delete</button>
        </li>
        <br/>
<?php
    }
?>
    </ul>


<!-- Add new item Button -->
    <p><button onclick="addNewImmunization(this)">Add New Item</button></p>




<!-- Pop-Up screen -->
    <?php include 'functions/getImmunizationList.php'; ?>    

    <div id="light5" class="white_content">
        Allergies: 
        
        <select id="immunizationList">
            <option selected="selected">Select an Item</option>
            
        <?php                        
            $result = getImmunizationList();    
            while($row = $result->fetch()){
        ?>
              <option value="<?php echo $row['Value']; ?>">
                <?php echo $row['Value']; ?>
              </option>
          <?php
            }
          ?>
        </select>

        <button id="btnSave5" onclick="updateImmunization()">Save</button>

        <br/>
        <br/>
        <!--<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>-->
        <a href = "javascript:void(0)" onclick = "closeImmunization()">Close</a>

        <br/>
        <br/>
        <i><div id="bottomLabel5"></div></i>
    </div>

    <div id="fade5" class="black_overlay"></div>

<!--******************************************-->
    

</body>
</html>
