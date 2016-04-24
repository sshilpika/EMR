var oldValue = '';
var fail='Failed to save changes. Please try again.';
var pass='Changes saved successfully';


function addCondition(ssn){
  var selectedLabel = $('#preList option:selected').text();
  console.log('addPreCond?ssn='+ssn+'&al='+selectedLabel);
  var $deferredAddAllergy = $.getJSON('addPreCond?ssn='+ssn+'&al='+selectedLabel);
  $deferredAddAllergy.done(function(response){
    console.log(JSON.stringify(response));
    allergyMessage(ssn,'pass',pass);
  });//add allergy
  $deferredAddAllergy.fail(function(response){
    console.log(JSON.stringify(response));
    allergyMessage(ssn,'fail',fail);
  });
}

function updateCondition(ssn){
  var condition = $('#preList option:selected').text();
  var $deferredAlSave = $.getJSON('savePreCondEdit?al1='+oldValue+'&ssn='+ssn+'&al2='+condition);
  $deferredAlSave.done(function(response){
    console.log(JSON.stringify(response));
    allergyMessage(ssn,'pass',pass);
    oldValue='';
  });//deferred obj done

  $deferredAlSave.fail(function(response){
    console.log(JSON.stringify(response));
    allergyMessage(ssn,'fail',fail);
  });// deferred obj save fail
}


function allergyMessage(ssn,ptype,message){

  $('#edit-message-precond').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-precond?ssn='+ssn, function(list) {
    $('div.precond').html(list); // show the list
    var p =$('<p>');
    p.attr("name", ptype);
    p.html(message);
    p.hide();
    $('#myModalPrecond').hide();
    $('#edit-message-precond').append(p);
    p.fadeIn('slow');
  });
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('myModalPrecond');
  console.log('modal window close '+modal);
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//close window on close button
$(document).on('click','.close',function(){
  console.log('for modal close '+JSON.stringify(this));
  $('#myModalPrecond').hide();

});

// save the selected allergy-edit
$(document).on('click','#preSave',function(){
  var ssn = $('#ssn').text();
  var saveType = document.getElementById('preSave').textContent;
  if(saveType ==='Save'){
    updateCondition(ssn,this);
  }else if (saveType ==='Add') {
    addCondition(ssn,this);
  }else{

  }
});


$(document).on('click','button.pre-edit',function(event){
  event.stopPropagation();
  document.getElementById('preSave').textContent='Save';
  oldValue = this.parentNode.textContent.split("\n")[1].trim();
  //console.log('OLD VAL FOR pre '+oldValue);
  var arr = $('.pre-value').map(function(i, el) {
    return $(el).text().trim();
  }).get();
  console.log('ARRAY'+JSON.stringify(arr));
  var $deferredAllergies = $.getJSON('getPreConditions');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#preList').empty();
    $('#preList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      if(item != null ){
        var al= item.Value;
        if(!(arr.indexOf(al)>-1)){
          var op = $('<option>');
          op.attr('value',al);
          console.log(al+' filtered AL');
          op.html(al);
          $('#preList').append(op);
        }
      }
    });//end of for each
    // When the user clicks the button, open the modal
    $('#myModalPrecond').show();
  });//end of deferred obj
});

$(document).on('click','button.pre-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[1].trim();

      var ssn = $('#ssn').text();
      var $deferredDeletePreCond = $.getJSON('deletePreCondition?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeletePreCond.done(function(){
        $('#edit-message-precond').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-precond?ssn='+$('#ssn').text(), function(list) {
            $('div.precond').html(list); // show the list
            var p =$('<p>');
            p.attr("name", "pass");
            p.html('Changes deleted successfully');
            p.hide();
            $('#myModalPrecond').hide();
            $('#edit-message-precond').append(p);
            p.fadeIn('slow');

        });
      });
      $deferredDeletePreCond.fail(function(){allergyMessage($('#ssn').text(),'fail',fail)});
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewPreCon',function(){
  document.getElementById('preSave').textContent='Add';
  var ssn = $('#ssn').text();
  var arr = $('.pre-value').map(function(i, el) {
    return $(el).text().trim();
  }).get();

  var $deferredAllergies = $.getJSON('getPreConditions');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#preList').empty();
    $('#preList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      if(item != null && !(arr.indexOf(item.Value) > -1)){
        var op = $('<option>');
        var al = item.Value;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#preList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    $('#myModalPrecond').show();

  });

});
