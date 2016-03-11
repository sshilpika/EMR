
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
       
        function updateCurrentStatus(){
            var newValue = document.getElementById('div6').textContent.trim();            
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'curr-status/updateCurrentStatus.php',
                data: { ssn: ssn, newValue: newValue},
                success: function(data){
                    alert(data);
                },
                error: function(data){                    
                    alert(data);
                }  
            });
        }
    
        function editBox6(btnEdit){
            if(btnEdit.textContent == "Edit"){
                document.getElementById('div6').contentEditable = "true";
                document.getElementById("div6").style.border = "thin dotted red";
                btnEdit.innerHTML = "Save";
            }
            else if(btnEdit.textContent == "Save"){
                updateCurrentStatus();
                /*document.getElementById('div6').contentEditable = "false";
                document.getElementById("div6").style.border = "1px solid black";
                btnEdit.innerHTML = "Edit";*/
                location.reload();
            }
        }

        function cancelBox6(btnEdit){            
            location.reload();
        }

    </script>        
</head>


<body>

    <div id="div6" contenteditable="false" style="border:1px solid black">
        <p>
            <?php
                include_once 'functions/getCurrentStatusByPatient.php';    
                $result = getCurrentStatusByPatient($ssn);            
                $row = $result->fetch();            
                if($row['Current_Status'] == '')  echo 'None';  
                else   echo $row['Current_Status'];
            ?>
        </p>        
    </div>
    <br/>
    
    <button id="btnEdit6" onclick="editBox6(this)">Edit</button>    
    <button id="btnCancel6" onclick="cancelBox6(this)">Cancel</button>    

</body>

</html>
