var dCounter = 1;
var mCounter = 1;
var map = {};
map['Select an Item'] = true;

$(document).on('click','#addDynamicDiagnosis',function(){
  var list = document.getElementById('addDiagnosisList');
  console.log(list.value);
  if(map[list.value] == undefined){
      var newAddDiv = $('<div>')
      newAddDiv.attr("id", 'addDiagDiv' + dCounter);
      newAddDiv.attr("class", 'addDiagDiv');
      newAddDiv.html(list.value);

      var btnRem = $('<button onclick="removeDiagAdd(' + dCounter + ')">' + "Remove </button>");
      btnRem.attr('class',"remDiag");
      btnRem.attr('id',"remDiag" + dCounter);
      btnRem.appendTo(newAddDiv);
      var div1 = $("#addDivGroup1");
      newAddDiv.hide();
      newAddDiv.appendTo(div1);
      newAddDiv.fadeIn("slow");
      dCounter++;
      map[list.value] = true;
  }
});

function removeDiagAdd(itemNum){
    var div = document.getElementById("addDiagDiv" + itemNum);;
    div.parentNode.removeChild(div);
    var item = div.textContent.split('Remove')[0];
    delete map[item];
}

$(document).on('click','#addDynamicPrescription',function(){
  var list = document.getElementById('addMedicineList');
  if(map[list.value] == undefined){
      var newAddDiv = $('<div>');
      newAddDiv.attr("id", 'addMedDiv' + mCounter);
      newAddDiv.attr("class", 'addMedDiv');
      newAddDiv.html(list.value);
      var txtBox = $('<input type="text">');
      txtBox.attr('id','addMedQuan'+mCounter);
      txtBox.attr('value','1');
      txtBox.attr('class','addMedQuanC');
      txtBox.appendTo(newAddDiv);

      var btnRem = $('<button onclick="removeMedAdd(' + mCounter + ')">' + "Remove </button>");
       btnRem.attr('class','remMed');
       btnRem.attr('id','remMed'+mCounter);
      btnRem.appendTo(newAddDiv);
      var div2 = $("#addDivGroup2");
      newAddDiv.hide();
      newAddDiv.appendTo(div2);
      newAddDiv.fadeIn("slow");
      mCounter++;
      map[list.value] = true;
  }
});

function removeMedAdd(itemNum){
    var div = document.getElementById("addMedDiv" + itemNum);;
    div.parentNode.removeChild(div);
    var item = div.textContent.split('Remove')[0];
    delete map[item];
}
