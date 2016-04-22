var oldValue = '';
$(document).on('click','button.allergy-edit',function(event){
    event.stopPropagation();
    document.getElementById('allergySave').textContent='Save';
    console.log(this.parentNode.textContent.split("\n")[1]);
    oldValue = this.parentNode.textContent.split("\n")[1].trim();
    var arr = $('.allergyLi').map(function(i, el) {
      return $(el).text().split("\n")[1].trim();
    }).get();
    getAllergies(arr,this);

});

function getAllergies(arr,self){
  console.log(arr+'array of allergies');
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

    console.log("MODAL------"+JSON.stringify($('#myModalAllergy')));

    $('#myModalAllergy').show();
    //document.getElementById('myModalAllergy').style.display = "block";
    console.log("MODAL---AFTER---"+document.getElementById('myModalAllergy').style.display);

  });//end of deferred obj
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  var modal = document.getElementById('myModalAllergy');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
//close window on close button
$(document).on('click','.close',function(){
  document.getElementById('myModalAllergy').style.display = "none";

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
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-allergies?ssn='+ssn, function(list) {
  $('div.allergies').html(list); // show the list

  var p =$('<p>');
  p.attr("name", "fail");
  p.html('Failed to save changes. Please try again.');
  p.hide();
  document.getElementById('myModalAllergy').style.display = "none";
  $('#edit-message').append(p);
  p.fadeIn('slow');
});
}

function allergyMessageSuccess(ssn){

  $('#edit-message').empty();

  var $deferredRefreshAl = $.get('/patient-allergies?ssn='+ssn, function(list) {
      $('div.allergies').html(list); // show the list
      var p =$('<p>');
      p.attr("name", "pass");
      p.html('Allergy changes saved');
      p.hide();
      document.getElementById('myModalAllergy').style.display = "none";
      $('#edit-message').append(p);
      p.fadeIn('slow');
      $(document).unbind();
  });//deferred refresh obj close
}

$(document).on('click','button.allergy-delete',function(event){
  //event.stopPropagation();
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
            p.attr("name", "pass");
            p.html('Allergy deleted');
            p.hide();
            document.getElementById('myModalAllergy').style.display = "none";
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
    return $(el).text().split("\n")[1].trim();
  }).get();
  console.log(JSON.stringify(arr));
  var $deferredAllergies = $.getJSON('getAllergies');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $allergies = response;
    $('#allergyList').empty();
    $('#allergyList').append($('<option selected="selected">Select an Item</option>'));
    $allergies.forEach(function(item){
      //console.log(JSON.stringify(algs));
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
    document.getElementById('myModalAllergy').style.display = "block";

  });

});

function createButton(buttonClass, buttonText) {
  //build button
  var $button = $('<button class="'+buttonClass+'">'+buttonText+'</button>');
  //return built button
  return $button;
}

//check element visibility - expects single element relative to display:none
function checkVisible(element) {
  //check if element is hidden or not
  if (element.is(":hidden")) {
    return true;
  } else {
    return false;
  }
}

//check elements exists
function checkExist(element) {
  //check specified elements or not - return boolean
  if (element.length) {
    return true;
  } else {
    return false;
  }
}



/*$(document).on('click','li.toggle',function(){
  //console.log(JSON.stringify(this.parentNode.textContent));
  if(!this.textContent.includes('Edit') && !this.textContent.includes('Delete')){
  console.log(JSON.stringify(this.textContent.split("\n")));

  //check if exists
  var buttons = $('.allergyLi button');

  console.log(checkExist(buttons));
  if((checkExist(buttons) === true)){

    console.log('in if');
    buttons.remove();
    //b2.remove();
  }else{
    var b1 = createButton('allergy-edit','Edit');
    var b2= createButton('allergy-delete','Delete');
    $('p.allergyLi').append(b1);
    $('p.allergyLi').append(b2);
  }
}
});*/
