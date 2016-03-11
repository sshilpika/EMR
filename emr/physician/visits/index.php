
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <script src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript">    
       var oldValueVisit='';
       var dateSelectedVisit='';

       var visitId='';
       var docName='';
       var billNum='';
       var comments='';
       var complaint='';
        
        /*function populateVisit(rowClicked){
            dateSelectedVisit = rowClicked.textContent.trim();                        
            var ssn = <?php echo $ssn; ?>;            

            $.ajax({
                type: "GET",
                url: 'visits/getVisitByDate.php',
                data: { ssn: ssn, dateValue: dateSelectedVisit},
                success: function(data){
                    var list = data.split(' --LINEBRAKE-- ');
                    visitId = list[0];
                    docName = list[1];
                    billNum = list[2];
                    commentsSuggestions = list[3];
                    complaint = list[4];                    
                    
                    //document.getElementById('visitBox').childNodes[1].innerHTML = billNum;
                    document.getElementById('visitId').textContent = visitId;
                    document.getElementById('docName').textContent = docName;
                    document.getElementById('billNum').textContent = billNum;
                    document.getElementById('commentsSuggestions').childNodes[1].textContent = commentsSuggestions;
                    document.getElementById('complaint').childNodes[1].textContent = complaint;
                },
                error: function(data){                            
                    document.getElementById('visitBox').innerHTML = data;
                }  
            });
        }*/

        function populateForm(rowClicked){
            dateSelectedVisit = rowClicked.textContent.trim();                        
            var ssn = <?php echo $ssn; ?>;                                    
            populateVisit(ssn);                        
            populateDiagnosis(visitId);
            populatePrescription(visitId);
        }
        function populateVisit(ssn){            
            $.ajax({
                type: "GET",
                url: 'visits/getVisitByDate.php',
                dataType: 'json',
                data: { ssn: ssn, dateValue: dateSelectedVisit},
                success: function(data){   
                    visitId = data.visitId;
                    docName = data.firstName + data.lastName;
                    billNum = data.billNum;
                    comments = data.comment;
                    complaint = data.complaint;                    
                    
                    //document.getElementById('visitBox').childNodes[1].innerHTML = billNum;
                    document.getElementById('visitId').textContent = visitId;
                    document.getElementById('docName').textContent = docName;
                    document.getElementById('billNum').textContent = billNum;
                    document.getElementById('commentsSuggestions').childNodes[1].textContent = comments;
                    document.getElementById('complaint').childNodes[1].textContent = complaint;
                },
                error: function(data){                            
                    document.getElementById('visitBox').innerHTML = data;
                },
                async: false  
            });             
        }
        function populateDiagnosis(visitId){                        
            $.ajax({
                type: "GET",
                url: 'visits/getDiagnosis.php',
                dataType: 'json',
                data: {visitId: visitId},
                success: function(data){   
                    var html = '';
                    for(var i=0; i<data.length; i++){                        
                        html += "<li>" + data[i] + "</li>";
                    }               
                    document.getElementById('diagnosisList').innerHTML = html;                    
                },
                error: function(data){                                                
                    document.getElementById('visitBox').innerHTML = data;
                },
                async: false  
            });
        }
    function populatePrescription(visitId){                        
            $.ajax({
                type: "GET",
                url: 'visits/getPrescription.php',
                dataType: 'json',
                data: {visitId: visitId},
                success: function(data){   
                    var tblHead = "<tr><th><i>Medicine</i></th><th><i>Quantity</i></th></tr>";
                    var html = "";
                    for(var i=0; i<data.length; i+=2){                        
                        html +="<tr>";
                        html += "<td>" + data[i] + "</td>";
                        html += "<td>" + data[i+1] + "</td>";
                        html +="</tr>";
                    }                    
                    document.getElementById('prescription').innerHTML = tblHead + html;
                },
                error: function(data){                                                
                    document.getElementById('visitBox').innerHTML = data;
                },
                async: false  
            });
        }


        function addNewVisit(addNewItem){
            document.getElementById('light7').style.display='block';
            document.getElementById('fade7').style.display='block';                                  
            document.getElementById('btnSave7Add').onclick = function(){ addVisit(document.getElementById('btnSave7Add')); };            
        }

        function addVisit(addBtn){                                                                 
            visitId = document.getElementById('addVisitId').textContent.trim();            
            docName = document.getElementById('addDocName').textContent.trim();
            
            billNum = document.getElementById('addBillNum').textContent.trim();
            comments = document.getElementById('addComments').textContent.trim();
            complaint = document.getElementById('addComplaint').textContent.trim();
            //alert(visitId+", "+docName+", "+billNum+", "+comments+", "+complaint);

            var ssn = <?php echo $ssn; ?>;


            var diagnosisList = document.getElementById('addDivGroup1').textContent.trim().split('Remove');
            diagnosisList = diagnosisList.join(',');


            var pharmacistId = "666666";

            
            var medicineInfo = "";
            var medicineList = document.getElementById('addDivGroup2').childNodes; 
            if(medicineList.length > 3){
                for(i=3; i<medicineList.length; i++){                    
                    var mName = medicineList[i].textContent.trim().split('Remove')[0];
                    var mQuan = medicineList[i].childNodes[1].value;
                    if(i > 3)   medicineInfo += ",";
                    medicineInfo += mName.trim() + ",";
                    medicineInfo += mQuan.trim();                    
                }
                //alert(medicineInfo);
            } 
            

            $.ajax({
                type: "POST",
                url: 'visits/addVisit.php',
                data: { visitId: visitId, docName: docName, billNum: billNum, comments: comments, complaint: complaint,
                        ssn: ssn,
                        diagnosisList: diagnosisList,
                        pharmacistId: pharmacistId,
                        medInfo: medicineInfo},
                success: function(data){
                    document.getElementById('bottomLabel7Add').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel7Add').textContent = data;
                }  
            });
        }
        

        function popUpVisit(){
            document.getElementById('light7').style.display='block';
            document.getElementById('fade7').style.display='block';
        }

        function editVisit(editBtn){
            popUpVisit();
            document.getElementById('popVisitId').textContent = visitId;
            document.getElementById('popDocName').textContent = docName;
            document.getElementById('popBillNum').textContent = billNum;
            document.getElementById('popCommentsSuggestions').childNodes[1].textContent = comments;
            document.getElementById('popComplaint').childNodes[1].textContent = complaint;
        }

        function updateVisit(saveBtn){            
            comments = document.getElementById('popCommentsSuggestions').childNodes[1].textContent;
            complaint = document.getElementById('popComplaint').childNodes[1].textContent;

            if(comments){
                document.getElementById('bottomLabel7').textContent = "Put something new";
                return;
            }    

            $.ajax({
                type: "POST",
                url: 'Visits/updateVisit.php',
                data: { ssn: ssn, newValue: newValue, entryDate: dateSelectedVisit},
                success: function(data){
                    document.getElementById('bottomLabel9').textContent = data;
                },
                error: function(data){                    
                    document.getElementById('bottomLabel9').textContent = data;
                }  
            });
        }

        
        function closeVisit(){
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
            <div id="dateVisit" style="border:thin dotted black">                
                <table id = "dateTableVisit" width="100%">
                <?php      
                    include 'functions/getVisitsDates.php';                  
                    $result = getVisitsDates($ssn);    
                    while($row = $result->fetch()){
                ?>
                    <tr onclick="populateForm(this)" style="cursor:pointer">
                        <td><?php echo $row['Date_Time']; ?></td>
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
            <?php include 'visitFormToDisplay.php'; ?>
        </td>

    </tr>    
</table>




<!-- Add new item Button -->
    <p><button onclick="addNewVisit(this)">Add New Visit</button></p>



<!-- Pop-Up screen -->  
    <div id="light7" class="white_content">        
        <?php include 'visitFormToAdd.php'; ?>
    </div>

    <div id="fade7" class="black_overlay"></div>
    


</body>

</html>
