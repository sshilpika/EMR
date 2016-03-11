
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
        var oldValue="";

        function popUpPreCon(editBtn){
            document.getElementById('light2').style.display='block';
            document.getElementById('fade2').style.display='block';
            
            var selectedLabel = editBtn.parentNode.textContent.split("\n")[1].trim();
            oldValue = selectedLabel;

            var dd = document.getElementById('preconditionList');
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].text === selectedLabel) {
                    dd.selectedIndex = i;                    
                    break;
                }
            }
            //alert(selectedItem);
        }

        function updatePreCon(){
            var newValue = document.getElementById('preconditionList').value;            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'pre-existing-condition/updatePreCondition.php',
                data: { ssn: ssn, oldValue: oldValue, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel2').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel2').textContent = data;
                }  
            });            
        }

        function deletePreCon(deleteBtn){
            var selectedLabel = deleteBtn.parentNode.textContent.split("\n")[1].trim();
            if (confirm('Are you sure you want to delete this item?')) {
                var ssn = <?php echo $ssn; ?>;            
                $.ajax({
                    type: "POST",
                    url: 'pre-existing-condition/deletePreCondition.php',
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

        function addNewPreCon(addNewItem){
            document.getElementById('light2').style.display='block';
            document.getElementById('fade2').style.display='block';
                      
            document.getElementById('btnSave2').textContent='Add';
            document.getElementById('btnSave2').onclick = function(){ addPreCon(document.getElementById('btnSave2')); };
        }

        function addPreCon(addBtn){            
            var newValue = document.getElementById('preconditionList').value;            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'pre-existing-condition/addPreCondition.php',
                data: { ssn: ssn, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel2').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel2').textContent = data;
                }  
            });
        }
        
        function closePreCon(){
            document.getElementById('light2').style.display='none';
            document.getElementById('fade2').style.display='none';
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
    $tableName = 'PatientsPreConditions';            
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
    include_once 'functions/getPreConditionsByPatient.php';    
    $result = getPreConditionsByPatient($ssn);            
    while ($row = $result->fetch()){
?>    
        <li>
            <?php echo $row['Value']; ?>    
            <button onclick="popUpPreCon(this)">Edit</button>
            <button onclick="deletePreCon(this)">Delete</button>
        </li>
        <br/>
<?php
    }
?>
    </ul>


<!-- Add new item Button -->
    <p><button onclick="addNewPreCon(this)">Add New Item</button></p>




<!-- Pop-Up screen -->
    <?php include 'functions/getPreConditionList.php'; ?>    

    <div id="light2" class="white_content">
        Pre-existing Conditions: 
        
        <select id="preconditionList">
            <option selected="selected">Select an Item</option>
            
        <?php                        
            $result = getPreConditionList();    
            while($row = $result->fetch()){
        ?>
              <option value="<?php echo $row['Value']; ?>">
                <?php echo $row['Value']; ?>
              </option>
          <?php
            }
          ?>
        </select>

        <button id="btnSave2" onclick="updatePreCon()">Save</button>

        <br/>
        <br/>
        <!--<a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'">Close</a>-->
        <a href = "javascript:void(0)" onclick = "closePreCon()">Close</a>

        <br/>
        <br/>
        <i><div id="bottomLabel2"></div></i>
    </div>

    <div id="fade2" class="black_overlay"></div>

<!--******************************************-->
    

</body>
</html>
