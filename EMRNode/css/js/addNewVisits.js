$(document).on('click','#addNewVisits',function(){
  //alert('adding new visits');
  var $visitCount = $.getJSON('getVisitCount');
  var $billCount = $.getJSON('getBillCount');
  var ssn = encodeURIComponent($("#ssn").text());
  var $physicianName = $.getJSON('getPhysicianName?id='+ssn);
  var $diagnosisCat = $.getJSON('getDiagnosisList');
  var $medName = $.getJSON('getMedicineList');

  $.when($visitCount,$billCount,$physicianName,$diagnosisCat,$medName).done(function(visitC,billC,pName,diagCatList,medList){
      //alert('back from DB');
      var vp = $('<p>');
      vp.html('V00'+visitC[0].Count);
      console.log('V00'+visitC[0].Count);
      $('#visitIdAdd').empty();
      $('#visitIdAdd').append(vp);

      var bp = $('<p>');
      var bill = billC[0].Count;
      $('#billNumAdd').empty();
      bp.html('B00'+Math.floor((Math.random() * 100) + bill));
      console.log('B00'+billC[0].Count);
      $('#billNumAdd').append(bp);

      var pn = $('<p>');
      console.log(pName[0].Name);
      pn.html(pName[0].Name);
      $('#docNameAdd').empty();
      $('#docNameAdd').append(pn);
      console.log(JSON.stringify(diagCatList[0]));
      $('#addDiagnosisList').empty();
      var op1 = $('<option selected="selected">Select an Item</option>');
      $('#addDiagnosisList').append(op1);
      diagCatList[0].forEach(function(diag){
        if(diag != null){
          var op = $('<option>');
          console.log('diag'+diag.Diagnosis_Category);
          op.attr('value',diag.Diagnosis_Category);
          op.html(diag.Diagnosis_Category);

          $('#addDiagnosisList').append(op);
        }
      });
      console.log(JSON.stringify(medList[0]));
      $('#addMedicineList').empty();
      var op1 = $('<option selected="selected">Select an Item</option>');
      $('#addMedicineList').append(op1);
      medList[0].forEach(function(mNames){
        if(mNames != null){
          var op = $('<option>');
          console.log('mNames'+JSON.stringify(mNames.Mname));
          op.attr('value',mNames.Mname);
          op.html(mNames.Mname);
          $('#addMedicineList').append(op);
        }
      });

      $('#addNewVisitModal').show();

    });//when deferred is done
});//new visit additions
$(document).on('click','#saveNewVisit',function(){
  var visitid = $('#visitIdAdd p').text().trim();
  var billnum = $('#billNumAdd p').text().trim();
  var physicianName = $('#docNameAdd p').text().trim();
  var comments = $('#addComments').text().trim();
  var complaints = $('#addComplaint').text().trim();
  var ssn = $('#ssn').text();
  var diagnosis = document.getElementById('addDivGroup1').textContent.trim().split('Remove');
  var diagList = diagnosis.join(',');
  var pharmacistId = "666666";// TODO
  //var presc = document.getElementById('addDivGroup2').textContent;
  var medicineList = document.getElementById('addDivGroup2').childNodes;
  var medicineInfo = "";
  console.log(medicineList.length+"medicineList"+medicineList.textContent);
  console.log(visitid);
  console.log(billnum);
  console.log(physicianName);
  console.log(comments);
  console.log(complaints);
  console.log(diagList);
  console.log(typeof(diagnosis)+'diagnosis');
  var diags = diagList.split(',');
  var dList = diags.filter(function(n){ return n != '' });
  console.log('DIAGS'+dList);
  var getDSSN = $.getJSON('getDocSSN?dName='+physicianName);
  getDSSN.done(function(response){
    var dSSN = response[0].SSN;
    var visitSave = $.post('addToVisit',
    {visitid:visitid,dSSN:dSSN,billNum:billnum,comments:comments,complaints:comments}).done(function(respV){
      var hasVisits = $.post('addToHasVisits',{pSSN:ssn,visitid:visitid}).done(function(resHV){
        for(i=0; i<dList.length; i++){
        var resultsV = $.post('addToResults',{visitId:visitid,diagnosisName:dList[i].trim()}).done(function(){
          console.log(diagList[i].trim()+'added to DB');
        });
      }
      if(medicineList.length > 0){
          for(i=1; i<medicineList.length; i++){
            var mName = medicineList[i].textContent.trim().split('Remove')[0];
            var mQuan = medicineList[i].childNodes[1].value;
            console.log(medicineList[i].textContent.trim());
            console.log(mName+'mName');
            $.getJSON('getPrescriptionId').done(function(rxres){
              var rxid = 'Rx'+rxres[0].RxId;
              console.log('RxId'+JSON.stringify(rxid));
              var addToPrescriptions = $.getJSON('addToPrescriptions?rxid='+rxid+'&visitid='+visitid+'&phid='+pharmacistId);
               addToPrescriptions.done(function(r1){
                 var prescWithPharm =$.getJSON('addToPrescribedMeds?rxid='+rxid+'&medname='+mName+'&medquan='+mQuan);
                 $.when(prescWithPharm).done(function(r2){
                   console.log('prescription saved '+rxid+mName+mQuan+visitid);
                 });
               });
            });
          }
        }
        allergyMessage(ssn,'pass','Changes saved successfully')
      console.log('prescription saved');
    });// add hasVisits
  });//visits add
});// DSSN
});

function allergyMessage(ssn,ptype,message){

  $('#edit-message-visits').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-visits?ssn='+ssn, function(list) {
    $('div.visits').html(list); // show the list
    var p =$('<p>');
    p.attr("name", ptype);
    p.html(message);
    p.hide();
    $('#addNewVisitModal').hide();
    $('#edit-message-visits').append(p);
    p.fadeIn('slow');
  });
}

window.onclick = function(event) {
  var modal = document.getElementById('addNewVisitModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//close window on close button
$(document).on('click','.visit-close',function(){
  document.getElementById('addNewVisitModal').style.display = "none";

});
