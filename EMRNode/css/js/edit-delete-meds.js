var oldValue = '';
var fail='Failed to save changes. Please try again.';
var pass='Changes saved successfully';


function addCondition(ssn){
  var selectedLabel = $('#medList option:selected').text();
  console.log('addMedications?ssn='+ssn+'&al='+selectedLabel);
  var $deferredAddAllergy = $.getJSON('addMedications?ssn='+ssn+'&al='+selectedLabel);
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
  var condition = $('#medList option:selected').text();
  var $deferredAlSave = $.getJSON('saveMedicationsEdit?al1='+oldValue+'&ssn='+ssn+'&al2='+condition);
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

  $('#edit-message-meds').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-medications?ssn='+ssn, function(list) {
    $('div.medications').html(list); // show the list
    var p =$('<p>');
    p.attr("name", ptype);
    p.html(message);
    p.hide();
    $('#myModalMedications').hide();
    $('#edit-message-meds').append(p);
    p.fadeIn('slow');
  });
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var $modal = document.getElementById('myModalMedications');
  console.log('modal window close '+$modal);
    if (event.target == $modal) {
        $modal.style.display='none';
    }
}
//close window on close button
$(document).on('click','.close',function(){
  console.log('for modal close '+JSON.stringify(this));
  $('#myModalMedications').hide();

});

// save the selected allergy-edit
$(document).on('click','#medSave',function(){
  var ssn = $('#ssn').text();
  var saveType = document.getElementById('medSave').textContent;
  if(saveType ==='Save'){
    updateCondition(ssn,this);
  }else if (saveType ==='Add') {
    addCondition(ssn,this);
  }else{

  }
});


$(document).on('click','button.med-edit',function(event){
  event.stopPropagation();
  document.getElementById('medSave').textContent='Save';
  oldValue = this.parentNode.textContent.split("\n")[1].trim();
  console.log('oldValue'+oldValue);
  //console.log(this.parentNode.textContent.split("\n")[1].trim());
  var arr = $('.medLi').map(function(i, el) {
    //console.log($(el).text().split("\n")[1].trim());
    return $(el).text().split("\n")[1].trim();
  }).get();
  console.log('ARRAY'+JSON.stringify(arr));
  var $deferredAllergies = $.getJSON('getMedications');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#medList').empty();
    $('#medList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      if(item != null ){
        var al= item.MedicineName;
        if(!(arr.indexOf(al)>-1)){
          var op = $('<option>');
          op.attr('value',al);
          console.log(al+' filtered AL');
          op.html(al);
          $('#medList').append(op);
        }
      }
    });//end of for each
    // When the user clicks the button, open the modal
    $('#myModalMedications').show();
  });//end of deferred obj
});

$(document).on('click','button.med-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[1].trim();
  console.log(JSON.stringify(this.parentNode.textContent.split("\n")[1].trim()));
  //if (confirm('Are you sure you want to delete this item?')) {
      var ssn = $('#ssn').text();
      var $deferredDeletePreCond = $.getJSON('deleteMedication?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeletePreCond.done(function(){
        $('#edit-message-meds').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-medications?ssn='+$('#ssn').text(), function(list) {
            $('div.medications').html(list); // show the list
            var p =$('<p>');
            p.attr("name", "pass");
            p.html('Changes deleted successfully');
            p.hide();
            $('#myModalMedications').hide();
            $('#edit-message-meds').append(p);
            p.fadeIn('slow');

        });
      });
      $deferredDeletePreCond.fail(function(){allergyMessage($('#ssn').text(),'fail',fail)});
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewMedication',function(){
  document.getElementById('medSave').textContent='Add';
  var ssn = $('#ssn').text();
  var arr = $('.medLi').map(function(i, el) {
    //console.log($(el).text().split("\n")[1].trim());
    return $(el).text().split("\n")[1].trim();
  }).get();

  var $deferredAllergies = $.getJSON('getMedications');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#medList').empty();
    $('#medList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      //console.log(JSON.stringify(arr)+"ARR");
      if(item != null && !(arr.indexOf(item.MedicineName) > -1)){
        var op = $('<option>');
        var al = item.MedicineName;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#medList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    console.log('Modal NEXT');
    $('#myModalMedications').show();

  });

});
