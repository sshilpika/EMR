
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
        var oldValue="";

        function popUpAllergy(editBtn){
            document.getElementById('light3').style.display='block';
            document.getElementById('fade3').style.display='block';
            
            var selectedLabel = editBtn.parentNode.textContent.split("\n")[1].trim();
            oldValue = selectedLabel;

            var dd = document.getElementById('allergyList');
            for (var i = 0; i < dd.options.length; i++) {
                if (dd.options[i].text === selectedLabel) {
                    dd.selectedIndex = i;                    
                    break;
                }
            }
            //alert(selectedItem);
        }

        function updateAllergy(){
            var newValue = document.getElementById('allergyList').value;            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'allergies/updateAllergy.php',
                data: { ssn: ssn, oldValue: oldValue, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel3').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel3').textContent = data;
                }  
            });            
        }

        function deleteAllergy(deleteBtn){
            var selectedLabel = deleteBtn.parentNode.textContent.split("\n")[1].trim();
            if (confirm('Are you sure you want to delete this item?')) {
                var ssn = <?php echo $ssn; ?>;            
                $.ajax({
                    type: "POST",
                    url: 'allergies/deleteAllergy.php',
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

        function addNewAllergy(addNewItem){
            document.getElementById('light3').style.display='block';
            document.getElementById('fade3').style.display='block';
                      
            document.getElementById('btnSave3').textContent='Add';
            document.getElementById('btnSave3').onclick = function(){ addAllergy(document.getElementById('btnSave3')); };
        }

        function addAllergy(addBtn){            
            var newValue = document.getElementById('allergyList').value;            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'allergies/addAllergy.php',
                data: { ssn: ssn, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel3').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel3').textContent = data;
                }  
            });
        }
        
        function closeAllergy(){
            document.getElementById('light3').style.display='none';
            document.getElementById('fade3').style.display='none';
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
    $tableName = 'PatientsAllergies';            
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
    include_once 'functions/getAllergiesByPatient.php';    
    $result = getAllergiesByPatient($ssn);            
    while ($row = $result->fetch()){
?>    
        <li>
            <?php echo $row['Value']; ?>    
            <button onclick="popUpAllergy(this)">Edit</button>
            <button onclick="deleteAllergy(this)">Delete</button>
        </li>
        <br/>
<?php
    }
?>
    </ul>


<!-- Add new item Button -->
    <p><button onclick="addNewAllergy(this)">Add New Item</button></p>




<!-- Pop-Up screen -->
    <?php include 'functions/getAllergyList.php'; ?>    

    <div id="light3" class="white_content">
        Allergies: 
        
        <select id="allergyList">
            <option selected="selected">Select an Item</option>
            
        <?php                        
            $result = getAllergyList();    
            while($row = $result->fetch()){
        ?>
              <option value="<?php echo $row['Value']; ?>">
                <?php echo $row['Value']; ?>
              </option>
          <?php
            }
          ?>
        </select>

        <button id="btnSave3" onclick="updateAllergy()">Save</button>

        <br/>
        <br/>
        <!--<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a>-->
        <a href = "javascript:void(0)" onclick = "closeAllergy()">Close</a>

        <br/>
        <br/>
        <i><div id="bottomLabel3"></div></i>
    </div>

    <div id="fade3" class="black_overlay"></div>

<!--******************************************-->
    

</body>
</html>
