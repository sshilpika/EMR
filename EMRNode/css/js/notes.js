$(document).on('click','tr.note-date',function(){

    var dateSelectedNote = this.textContent.trim();
   getNote(dateSelectedNote);

});
function getNote(dateSelectedNote){

    var ssn = $('#ssn').text();
    var $deferredNotes = $.getJSON('getPatientNotes?date='+dateSelectedNote+'&ssn='+ssn);
  //var $deferredNoteDates = $.getJSON('getPatientNotes?date='dateSelectedNote+'&ssn='+ssn,function(){});
    $.when($deferredNotes).done(function(response){
        var $notes = response;
          $("#noteBox").empty();
        $notes.forEach(function(item){
          if(item != null){

            console.log(JSON.stringify(item.Comments));
            $('#noteBox').append(item.Comments);
          }
        });
    });

}
