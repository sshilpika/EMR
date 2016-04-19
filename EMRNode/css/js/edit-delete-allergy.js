var oldValue = '';
$(document).on('click','button.allergy-edit',function(){
    document.getElementById('allergySave').textContent='Save';
    oldValue = this.parentNode.textContent.split("\n")[1].trim();
    var arr = $('.allergyLi').map(function(i, el) {
      return $(el).text();
    }).get();
    getAllergies(arr);

});

function getAllergies(arr){
  var $deferredAllergies = $.getJSON('getAllergies');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $allergies = response;
    $('#allergyList').empty();
    $('#allergyList').append($('<option selected="selected">Select an Item</option>'));
    $allergies.forEach(function(item){
      if(item != null && !(arr.indexOf(item.Value)>-1)){
        var op = $('<option>');
        var al = item.Value;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#allergyList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    document.getElementById('myModal').style.display = "block";

  });//end of deferred obj
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('myModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//close window on close button
$(document).on('click','.close',function(){
  document.getElementById('myModal').style.display = "none";

});

// save the selected allergy-edit
$(document).on('click','#allergySave',function(){
  var ssn = $('#ssn').text();
  var saveType = document.getElementById('allergySave').textContent;
  if(saveType ==='Save'){
    updateAllergy(ssn);
  }else if (saveType ==='Add') {
    addAllergy(ssn);
  }else{

  }
});

function addAllergy(ssn){
  var selectedLabel = $('#allergyList option:selected').text();
  var $deferredAddAllergy = $.getJSON('addAllergy?ssn='+ssn+'&al='+selectedLabel);
  $deferredAddAllergy.done(function(response){
    console.log(JSON.stringify(response));
    allergyMessageSuccess(ssn);
  });//add allergy
  $deferredAddAllergy.fail(function(response){
    console.log(JSON.stringify(response));
    allergyMessageFail();
  });
}

function updateAllergy(ssn){
  var allergy = $('#allergyList option:selected').text();


  var $deferredAlSave = $.getJSON('saveAllergyEdit?al1='+oldValue+'&ssn='+ssn+'&al2='+allergy);
  $deferredAlSave.done(function(response){
    console.log(JSON.stringify(response));
    allergyMessageSuccess(ssn);
    oldValue='';
  });//deferred obj done

  $deferredAlSave.fail(function(response){
    console.log(JSON.stringify(response));
    allergyMessageFail();
    oldValue='';
  });// deferred obj save fail
}

function allergyMessageFail(){

  $('#edit-message').empty();
  var p =$('<p>');
  p.html('Failed to save changes. Please try again.');
  p.hide();
  document.getElementById('myModal').style.display = "none";
  $('#edit-message').append(p);
  p.fadeIn('slow');
}

function allergyMessageSuccess(ssn){

  $('#edit-message').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-allergies?ssn='+ssn, function(list) {
      $('div.allergies').html(list); // show the list
      var p =$('<p>');
      p.html('Allergy changes saved');
      p.hide();
      document.getElementById('myModal').style.display = "none";
      $('#edit-message').append(p);
      p.fadeIn('slow');

  });//deferred refresh obj close
}

$(document).on('click','button.allergy-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[1].trim();
  //if (confirm('Are you sure you want to delete this item?')) {
      var ssn = $('#ssn').text();
      var $deferredDeleteAllergy = $.getJSON('deleteAllergy?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeleteAllergy.done(function(){
        $('#edit-message').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-allergies?ssn='+$('#ssn').text(), function(list) {
            $('div.allergies').html(list); // show the list
            var p =$('<p>');
            p.html('Allergy deleted');
            p.hide();
            document.getElementById('myModal').style.display = "none";
            $('#edit-message').append(p);
            p.fadeIn('slow');

        });
      });
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewAllergy',function(){
  document.getElementById('allergySave').textContent='Add';
  var ssn = $('#ssn').text();
  var arr = $('.allergyLi').map(function(i, el) {
    return $(el).text();
  }).get();
  alert(JSON.stringify(arr));
  var $deferredAllergies = $.getJSON('getAllergies');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $allergies = response;
    $('#allergyList').empty();
    $('#allergyList').append($('<option selected="selected">Select an Item</option>'));
    $allergies.forEach(function(item){
      //alert(JSON.stringify(algs));
      if(item != null && !(arr.indexOf(item.Value) > -1)){
        var op = $('<option>');
        var al = item.Value;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#allergyList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    document.getElementById('myModal').style.display = "block";

  });

});
