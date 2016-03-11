
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
       var oldValueNote='';
       var dateSelectedNote='';
        
        function getNote(rowClicked){
            dateSelectedNote = rowClicked.textContent.trim();            
            var ssn = <?php echo $ssn; ?>;            
            
            $.ajax({
                type: "GET",
                url: 'notes/getNoteByPatient.php',
                data: { ssn: ssn, dateValue: dateSelectedNote},
                success: function(data){
                    document.getElementById('noteBox').childNodes[1].innerHTML = data;
                },
                error: function(data){                            
                    document.getElementById('noteBox').innerHTML = data;
                }  
            });            
        }

        function addNewNote(addNewItem){
            document.getElementById('light9').style.display='block';
            document.getElementById('fade9').style.display='block';
                                  
            document.getElementById('btnSave9').onclick = function(){ addNote(document.getElementById('btnSave9')); };
        }

        function addNote(addBtn){                        
            var newValue = document.getElementById('txtArea9').textContent.trim();
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "POST",
                url: 'notes/addNote.php',
                data: { ssn: ssn, newValue: newValue},
                success: function(data){
                    document.getElementById('bottomLabel9').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel9').textContent = data;
                }  
            });
        }

        function popUpNote(editBtn){
            document.getElementById('light9').style.display='block';
            document.getElementById('fade9').style.display='block';
            
            oldValueNote = document.getElementById('noteBox').childNodes[1].textContent;            
            document.getElementById('txtArea9').textContent = oldValueNote;
        }


        function updateNote(saveBtn){            
            //var newValue = document.getElementById('txtArea9').value.trim();                        
            var newValue = document.getElementById('txtArea9').textContent.trim();            
            var ssn = <?php echo $ssn; ?>;            

            if(oldValueNote == newValue){
                document.getElementById('bottomLabel9').textContent = "Put something new";
                return;
            }    

            $.ajax({
                type: "POST",
                url: 'notes/updateNote.php',
                data: { ssn: ssn, newValue: newValue, entryDate: dateSelectedNote},
                success: function(data){
                    document.getElementById('bottomLabel9').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel9').textContent = data;
                }  
            });
        }

        
        function closeNote(){
            document.getElementById('light9').style.display='none';
            document.getElementById('fade9').style.display='none';
            location.reload();
        }

    </script>        
</head>


<body>

<!--<table width="100%" border="1" cellpadding="3" cellspacing="0">    -->
<table width="100%" style="border:1px solid black">   
    <tr>
        <!-- Left Panel -->
        <td width="20%">
        Select a Date:
            <div id="dateNote" style="border:thin dotted black">                
                <table id = "dateTableNote" width="100%">
                <?php      
                    include 'functions/getNotesDates.php';                  
                    $result = getNotesDates($ssn);    
                    while($row = $result->fetch()){
                ?>
                    <tr onclick="getNote(this)" style="cursor:pointer">
                        <td><?php echo $row['EntryDate']; ?></td>
                    </tr>                      
                <?php
                    }
                ?>                    
                </table>
            </div>
        </td>



        <!-- Detail Right Panel-->
        <td width="80%">
        Detail:
            <div id="detailNote">
                <div id="noteBox" contenteditable="false" style="border:thin dotted black">                
                <p>
                    <!-- Child Node 1 -->
                </p>                        
                </div>
                                
                <p align="right">
                    <button id="btnEdit9" onclick="popUpNote(this)">Edit This Note</button>    
                </p>
            </div>
        </td>

    </tr>    
</table>



<!-- Add new item Button -->
    <p><button onclick="addNewNote(this)">Add New Note</button></p>

<!-- Pop-Up screen -->    
    <div id="light9" class="white_content">
        Write something below:
        <br/>

        <!--<textarea id="txtArea9" rows="1"></textarea>            -->
        <p><div id="txtArea9" contenteditable="true" style="border:1px dotted black" align="left" width="50%">
        <p>
            
        </p>
        </div></p>
    
        <button id="btnSave9" onclick="updateNote()">Save</button>

        <br/>
        <br/>
        <!--<a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'">Close</a>-->
        <a href = "javascript:void(0)" onclick = "closeNote()">Close</a>

        <br/>
        <br/>
        <i><div id="bottomLabel9"></div></i>
    </div>

    <div id="fade9" class="black_overlay"></div>


</body>

</html>
