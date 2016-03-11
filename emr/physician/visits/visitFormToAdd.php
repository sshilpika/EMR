<script type="text/javascript">
    var map = {};
    map['Select an Item'] = true;    

    var dCounter = 1;
    function addDynamicDiagnosis(){
        var list = document.getElementById('addDiagnosisList'); 
        if(map[list.value] == undefined){
            var newAddDiv = $(document.createElement('div')).attr("id", 'addDiagDiv' + dCounter);
            newAddDiv.html(list.value);

            var btnRem = $('<button id="remDiag"' + dCounter + ' onclick="removeDiagAdd(' + dCounter + ')">' + "Remove </button>");
            btnRem.appendTo(newAddDiv);
            newAddDiv.appendTo("#addDivGroup1");            

            dCounter++;
            map[list.value] = true;
        }        
    }

    var mCounter = 1;
    function addDynamicPrescription(){
        var list = document.getElementById('addMedicineList');
        if(map[list.value] == undefined){
            var newAddDiv = $(document.createElement('div')).attr("id", 'addMedDiv' + mCounter);        
            newAddDiv.html(list.value);
            
            var txtBox = $('<input type="text" id="addMedQuan"' + mCounter + ' value="1" style="width:40px; text-align:center">');
            txtBox.appendTo(newAddDiv);
      
            var btnRem = $('<button id="remMed"' + mCounter + ' onclick="removeMedAdd(' + mCounter + ')">' + "Remove </button>");
            btnRem.appendTo(newAddDiv);            
            newAddDiv.appendTo("#addDivGroup2");
            mCounter++;
            map[list.value] = true;
        }
    }


    function removeDiagAdd(itemNum){        
        var div = document.getElementById("addDiagDiv" + itemNum);;        
        div.parentNode.removeChild(div);
        var item = div.textContent.split('Remove')[0];
        delete map[item];
    }
    function removeMedAdd(itemNum){        
        var div = document.getElementById("addMedDiv" + itemNum);;        
        div.parentNode.removeChild(div);
        var item = div.textContent.split('Remove')[0];
        delete map[item];
    }

    
</script>




<?php include 'functions/getCountsAndName.php'; ?>

<div id="addPopUpBox" contenteditable="false" style="border:thin solid black">                
    <p> <!-- Child Node 1 -->                    
        <i>Visit Id:</i> <b><label id="addVisitId">
                        <?php                  
                            $result = getVisitCount();    
                            $row = $result->fetch();
                            echo 'V'.$row['Count'];
                        ?>
                    </label></b><br/><br/>        

        <i>Physician Name:</i> <b><label id="addDocName">
                        <?php                  
                            $result = getPhysicianName($ssn);    
                            $row = $result->fetch();
                            echo $row['Name'];
                        ?>
                        </label></b><br/><br/>

        <i>Bill Num:</i> <b><label id="addBillNum">
                    <?php                  
                        $result = getBillCount();    
                        $row = $result->fetch();
                        echo 'B'.$row['Count'];
                    ?>
                    </label></b><br/><br/><br/>
                    
                   
        <i>Diagnosis:</i>  
        <div id="addDiagnosis" contenteditable="false" style="border:thin dotted black">                                
            <div id='addDivGroup1'>
                <!--<div id="addDiv1" contenteditable="false">Hello World</div>-->
            </div>

            <select id="addDiagnosisList">
                <option selected="selected">Select an Item</option>                
            <?php                        
                include 'functions/getDiagnosisList.php';
                $result = getDiagnosisList();    
                while($row = $result->fetch()){
            ?>
                  <option value="<?php echo $row['Diagnosis_Category']; ?>">
                    <?php echo $row['Diagnosis_Category']; ?>
                  </option>
              <?php
                }
              ?>
            </select>    
            <button id="addBtnDiagnosis" onclick="addDynamicDiagnosis()">Add</button>            
        </div><br/>



        <i>Prescription:</i>  
        <div id="addPrescription" contenteditable="false" style="border:thin dotted black">                                
            <div id='addDivGroup2'>
                <!--<div id="addDiv1" contenteditable="false">Hello World</div>-->
            </div>

            <select id="addMedicineList">
                <option selected="selected">Select an Item</option>                
            <?php                        
                include 'functions/getMedicineList.php';
                $result = getMedicineList();    
                while($row = $result->fetch()){
            ?>
                  <option value="<?php echo $row['Mname']; ?>">
                    <?php echo $row['Mname']; ?>
                  </option>
              <?php
                }
              ?>
            </select>    
            <button id="addBtnPrescription" onclick="addDynamicPrescription()">Add</button>            
        </div><br/>




        <i>Comments:</i>   <div id="addComments" contenteditable="true" style="border:thin dotted black">
                                <p></p>
                                </div><br/>
                     
        <i>Complaint:</i>  <div id="addComplaint" contenteditable="true" style="border:thin dotted black">
                    <p></p>
                    </div>
    </p>                        
</div>

<br/>
<button id="btnSave7Add" onclick="addVisit(this)">Save</button>

<br/>
<br/>
<!--<a href = "javascript:void(0)" onclick = "document.getElementById('light2').style.display='none';document.getElementById('fade2').style.display='none'">Close</a>-->
<a href = "javascript:void(0)" onclick = "closeVisit()">Close</a>

<br/>
<br/>
<i><div id="bottomLabel7Add"></div></i>