var oldValue = '';
var fail='Failed to save changes. Please try again.';
var pass='Changes saved successfully';


function addCondition(ssn){
  var selectedLabel = $('#immList option:selected').text();
  console.log('addImmunizations?ssn='+ssn+'&al='+selectedLabel);
  var $deferredAddAllergy = $.getJSON('addImmunizations?ssn='+ssn+'&al='+selectedLabel);
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
  var condition = $('#immList option:selected').text();
  var $deferredAlSave = $.getJSON('saveImmunizationsEdit?al1='+oldValue+'&ssn='+ssn+'&al2='+condition);
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

  $('#edit-message-immunization').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-immunizations?ssn='+ssn, function(list) {
    $('div.Immunizations').html(list); // show the list
    var p =$('<p>');
    p.attr("name", ptype);
    p.html(message);
    p.hide();
    $('#myModalImmunizations').hide();
    $('#edit-message-immunization').append(p);
    p.fadeIn('slow');
  });
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('myModalImmunizations');
  console.log('modal window close '+modal);
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//close window on close button
$(document).on('click','.close',function(){
  console.log('for modal close '+JSON.stringify(this));
  $('#myModalImmunizations').hide();

});

// save the selected allergy-edit
$(document).on('click','#immSave',function(){
  var ssn = $('#ssn').text();
  var saveType = document.getElementById('immSave').textContent;
  if(saveType ==='Save'){
    updateCondition(ssn,this);
  }else if (saveType ==='Add') {
    addCondition(ssn,this);
  }else{

  }
});


$(document).on('click','button.imm-edit',function(event){
  event.stopPropagation();
  document.getElementById('immSave').textContent='Save';
  oldValue = this.parentNode.textContent.split("\n")[1].trim();
  console.log('oldValue'+oldValue);
  var arr = $('.immLi').map(function(i, el) {
    return $(el).text().split("\n")[1].trim();
  }).get();
  console.log('ARRAY'+JSON.stringify(arr));
  var $deferredAllergies = $.getJSON('getImmunizations');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#immList').empty();
    $('#immList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      if(item != null ){
        var al= item.Value;
        if(!(arr.indexOf(al)>-1)){
          var op = $('<option>');
          op.attr('value',al);
          console.log(al+' filtered AL');
          op.html(al);
          $('#immList').append(op);
        }
      }
    });//end of for each
    // When the user clicks the button, open the modal
    $('#myModalImmunizations').show();
  });//end of deferred obj
});

$(document).on('click','button.imm-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[1].trim();
  console.log(JSON.stringify(this.parentNode.textContent.split("\n")[1].trim()));
  //if (confirm('Are you sure you want to delete this item?')) {
      var ssn = $('#ssn').text();
      var $deferredDeletePreCond = $.getJSON('deleteImmunizations?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeletePreCond.done(function(){
        $('#edit-message-immunization').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-immunizations?ssn='+$('#ssn').text(), function(list) {
            $('div.immunizations').html(list); // show the list
            var p =$('<p>');
            p.attr("name", "pass");
            p.html('Changes deleted successfully');
            p.hide();
            $('#myModalImmunizations').hide();
            $('#edit-message-immunization').append(p);
            p.fadeIn('slow');

        });
      });
      $deferredDeletePreCond.fail(function(){allergyMessage($('#ssn').text(),'fail',fail)});
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewImmunization',function(){
  document.getElementById('immSave').textContent='Add';
  var ssn = $('#ssn').text();
  var arr = $('.immLi').map(function(i, el) {
    return $(el).text().split("\n")[1].trim();
  }).get();

  var $deferredAllergies = $.getJSON('getImmunizations');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#immList').empty();
    $('#immList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      if(item != null && !(arr.indexOf(item.Value) > -1)){
        var op = $('<option>');
        var al = item.Value;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#immList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    $('#myModalImmunizations').show();

  });

});
