$(document).on('change','select.note-select',function(){

    var dateSelectedNote = $('option:selected', this).attr('name');
    getNote(dateSelectedNote);

});
function getNote(dateSelectedNote){

    var ssn = $('#ssn').text();
    var $deferredNotes = $.getJSON('getPatientNotes?date='+dateSelectedNote+'&ssn='+ssn);
    $.when($deferredNotes).done(function(response){
        var $notes = response;
          $("#noteBox").empty();
          $("#noteTable").show();
        $notes.forEach(function(item){
          if(item != null){

            console.log(JSON.stringify(item.Comments));
            $('#noteBox').append(item.Comments);
          }
        });
    });

}
