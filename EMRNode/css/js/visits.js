

$(document).on('change','select',function(){

   var dateSelectedVisit = $('option:selected', this).attr('name');;
   var ssn = $('#ssn').text();
   populateVisit(dateSelectedVisit);

});
function populateVisit(dateSelectedVisit){

  var $deferredVisits = $.getJSON('visitsByDate?date='+dateSelectedVisit);

  $.when($deferredVisits).done(function(response){
      //clear visit by date
      console.log(response+"!!!!!!!!!");
      $("td.visit-by-date").empty();
      //get travelNotes
      var $travelNotes = response;
      //process travelNotes array
      console.log('TRVL NOTES '+JSON.stringify($travelNotes));
      //$("td.visit-by-date").load("css/html-templates/visitFormToDisplay.html", function(){
        $travelNotes.forEach(function(item) {
          if (item !== null) {
            var note = item;
            console.log(JSON.stringify(item));
            var visitId = item.Visit_ID;
            var docName = item.First_Name + item.Last_Name;
            var billNum = item.Bill_Num;
            var comments = item.CommentsSuggestions;
            var complaint = item.Complaint;
            var $deferredDiagnosis = $.getJSON('getDiagnosis?visitId='+visitId);
            var $deferredPrescriptions = $.getJSON('getPrescription?visitId='+visitId);

            $.when($deferredDiagnosis,$deferredPrescriptions).done(function(resD, resP){
              var $diagnosis = resD;
              var $prescription = resP;
              console.log('D '+JSON.stringify($diagnosis));
              console.log('P '+JSON.stringify($prescription));
              $("td.visit-by-date").load("css/html-templates/visitFormToDisplay.html", function(){
                $diagnosis[0].forEach(function(diag){
                  var li = $("<li>");
                  li.html(diag.Diagnosis_Category);
                  $('#diagnosisList').append(li);
                });// end of diagnosis

                $prescription[0].forEach(function(pres){
                  var tr = $("<tr>");
                  var td = $("<td>"), td1 = $("<td>")
                  td.html(pres.Mname); td1.html(pres.Medicine_Quantity);
                  tr.append([td,td1]);

                  $('#prescription').append(tr);
                });// end of prescription
                $("#visitId").append(visitId);
                $("#docName").append(docName);
                $("#billNum").append(billNum);
                $("#commentsSuggestions").append(comments);
                $("#complaint").append(complaint);
              });//end of load
            });

          }//end of if
        });//end of forEach
      //});//end of load

    });
}


$(document).on('click','#datepicker',function(){

    //$( "#datepicker" ).datepicker();
});
