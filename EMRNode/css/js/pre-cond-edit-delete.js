var oldValue = '';
var tabType='';
var refresh='';

function getConditions(arr,path,value){
  alert('ARRAY'+JSON.stringify(arr));
  var $deferredAllergies = $.getJSON(path);
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#conditionList').empty();
    $('#conditionList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){

      if(item != null ){
        var al ='';
        if(value==='Value')
        al= item.Value;
        else
        al=item.MedicineName;
        //alert(al);
        if(!(arr.indexOf(al)>-1)){
        var op = $('<option>');
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#conditionList').append(op);
      }
    }
    });//end of for each
    // When the user clicks the button, open the modal
    document.getElementById('myModal').style.display = "block";

  });//end of deferred obj
}

function addCondition(ssn,tabType){
  var selectedLabel = $('#conditionList option:selected').text();
  console.log('add'+tabType+'?ssn='+ssn+'&al='+selectedLabel);
  var $deferredAddAllergy = $.getJSON('add'+tabType+'?ssn='+ssn+'&al='+selectedLabel);
  $deferredAddAllergy.done(function(response){
    console.log(JSON.stringify(response));
    allergyMessageSuccess(ssn);
  });//add allergy
  $deferredAddAllergy.fail(function(response){
    console.log(JSON.stringify(response));
    allergyMessageFail();
  });
}

function updateCondition(ssn,tabType){
  var condition = $('#conditionList option:selected').text();
  var $deferredAlSave = $.getJSON('save'+tabType+'Edit?al1='+oldValue+'&ssn='+ssn+'&al2='+condition);
  $deferredAlSave.done(function(response){
    console.log(JSON.stringify(response));
    allergyMessageSuccess(ssn);
    oldValue='';tabType='';
  });//deferred obj done

  $deferredAlSave.fail(function(response){
    console.log(JSON.stringify(response));
    allergyMessageFail();
    oldValue='';refresh='';tabType='';
  });// deferred obj save fail
}


function allergyMessageFail(){

  $('#edit-message').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-'+refresh+'?ssn='+ssn, function(list) {
  $('div.'+refresh).html(list); // show the list
  refresh='';
  var p =$('<p>');
  p.attr("name", "fail");
  p.html('Failed to save changes. Please try again.');
  p.hide();
  document.getElementById('myModal').style.display = "none";
  $('#edit-message').append(p);
  p.fadeIn('slow');
});
}

function allergyMessageSuccess(ssn){

  $('#edit-message').empty();
  $(document).unbind();
  var $deferredRefreshAl = $.get('/patient-'+refresh+'?ssn='+ssn, function(list) {
      alert('REFRESH'+refresh);
      $('div.'+refresh).html(list); // show the list
      refresh='';
      var p =$('<p>');
      p.attr("name", "pass");
      p.html('Changes saved successfully');
      p.hide();
      document.getElementById('myModal').style.display = "none";
      $('#edit-message').append(p);
      p.fadeIn('slow');

  });//deferred refresh obj close
}

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
$(document).on('click','#conditionSave',function(){
  var ssn = $('#ssn').text();
  alert(tabType);
  var saveType = document.getElementById('conditionSave').textContent;
  if(saveType ==='Save'){
    updateCondition(ssn,tabType);
  }else if (saveType ==='Add') {
    addCondition(ssn,tabType);
  }else{

  }
});


$(document).on('click','button.pre-edit',function(){
  document.getElementById('conditionSave').textContent='Save';
  tabType='PreCond';
  refresh='precond';
  oldValue = this.parentNode.textContent.split("\n")[3].trim();
  var arr = $('.pre-value').map(function(i, el) {
    return $(el).text().trim();
  }).get();
  getConditions(arr,'getPreConditions','Value');
});

$(document).on('click','button.pre-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[3].trim();
  //alert(JSON.stringify(this.parentNode.textContent.split("\n")[3].trim()));
  //if (confirm('Are you sure you want to delete this item?')) {
      var ssn = $('#ssn').text();
      var $deferredDeletePreCond = $.getJSON('deletePreCondition?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeletePreCond.done(function(){
        $('#edit-message').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-precond?ssn='+$('#ssn').text(), function(list) {
            $('div.precond').html(list); // show the list
            var p =$('<p>');
            p.attr("name", "pass");
            p.html('Pre-existing condition deleted successfully');
            p.hide();
            document.getElementById('myModal').style.display = "none";
            $('#edit-message').append(p);
            p.fadeIn('slow');

        });
      });
      $deferredDeletePreCond.fail(function(){allergyMessageSuccess($('#ssn').text())});
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewPreCon',function(){
  document.getElementById('conditionSave').textContent='Add';
  var ssn = $('#ssn').text();
  tabType='PreCond';
  refresh='precond';
  var arr = $('.pre-value').map(function(i, el) {
    return $(el).text().trim();
  }).get();

  var $deferredAllergies = $.getJSON('getPreConditions');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#conditionList').empty();
    $('#conditionList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      //alert(JSON.stringify(algs));
      if(item != null && !(arr.indexOf(item.Value) > -1)){
        var op = $('<option>');
        var al = item.Value;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#conditionList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    document.getElementById('myModal').style.display = "block";

  });

});

$(document).on('click','button.med-edit',function(){
  document.getElementById('conditionSave').textContent='Save';
  tabType='Medications';
  refresh='medications';
  oldValue = this.parentNode.textContent.split("\n")[1].trim();
  //alert(this.parentNode.textContent.split("\n")[1].trim());
  var arr = $('.medLi').map(function(i, el) {
    //alert($(el).text().split("\n")[1].trim());
    return $(el).text().split("\n")[1].trim();
  }).get();
  getConditions(arr,'getMedications','MedicineName');
});

$(document).on('click','button.med-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[1].trim();
  //alert(JSON.stringify(this.parentNode.textContent.split("\n")[1].trim()));
  //if (confirm('Are you sure you want to delete this item?')) {
      var ssn = $('#ssn').text();
      var $deferredDeletePreCond = $.getJSON('deleteMedication?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeletePreCond.done(function(){
        $('#edit-message').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-medications?ssn='+$('#ssn').text(), function(list) {
            $('div.medications').html(list); // show the list
            var p =$('<p>');
            p.attr("name", "pass");
            p.html('Pre-existing condition deleted successfully');
            p.hide();
            document.getElementById('myModal').style.display = "none";
            $('#edit-message').append(p);
            p.fadeIn('slow');

        });
      });
      $deferredDeletePreCond.fail(function(){allergyMessageSuccess($('#ssn').text())});
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewMedication',function(){
  document.getElementById('conditionSave').textContent='Add';
  var ssn = $('#ssn').text();
  tabType='Medications';
  refresh='medications';
  var arr = $('.medLi').map(function(i, el) {
    //alert($(el).text().split("\n")[1].trim());
    return $(el).text().split("\n")[1].trim();
  }).get();

  var $deferredAllergies = $.getJSON('getMedications');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#conditionList').empty();
    $('#conditionList').append($('<option selected="selected">Select an Item</option>'));
    $conditions.forEach(function(item){
      //alert(JSON.stringify(arr)+"ARR");
      if(item != null && !(arr.indexOf(item.MedicineName) > -1)){
        var op = $('<option>');
        var al = item.MedicineName;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#conditionList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    document.getElementById('myModal').style.display = "block";

  });

});


$(document).on('click','button.imm-edit',function(){
  document.getElementById('conditionSave').textContent='Save';
  tabType='Immunizations';
  refresh='immunizations';
  oldValue = this.parentNode.textContent.split("\n")[1].trim();
  var arr = $('.immLi').map(function(i, el) {
    return $(el).text().split("\n")[1].trim();
  }).get();
  getConditions(arr,'getImmunizations','Value');
});

$(document).on('click','button.imm-delete',function(){
  var selectedLabel = this.parentNode.textContent.split("\n")[1].trim();
  alert(JSON.stringify(this.parentNode.textContent.split("\n")[1].trim()));
  //if (confirm('Are you sure you want to delete this item?')) {
      var ssn = $('#ssn').text();
      var $deferredDeletePreCond = $.getJSON('deleteImmunizations?ssn='+ssn+'&al='+selectedLabel);
      $deferredDeletePreCond.done(function(){
        $('#edit-message').empty();
        $(document).unbind();
        var $deferredRefreshAl = $.get('/patient-immunizations?ssn='+$('#ssn').text(), function(list) {
            $('div.immunizations').html(list); // show the list
            var p =$('<p>');
            p.attr("name", "pass");
            p.html('Immunization deleted successfully');
            p.hide();
            document.getElementById('myModal').style.display = "none";
            $('#edit-message').append(p);
            p.fadeIn('slow');

        });
      });
      $deferredDeletePreCond.fail(function(){allergyMessageSuccess($('#ssn').text())});
  //} else {
      // Do nothing!
  //}
});

$(document).on('click','#addNewImmunization',function(){
  document.getElementById('conditionSave').textContent='Add';
  var ssn = $('#ssn').text();
  tabType='Immunizations';
  refresh='immunizations';
  var arr = $('.immLi').map(function(i, el) {
    return $(el).text().split("\n")[1].trim();
  }).get();

  var $deferredAllergies = $.getJSON('getImmunizations');
  $.when($deferredAllergies).done(function(response){
    console.log(JSON.stringify(response));
    $conditions = response;
    $('#conditionList').empty();
    $('#conditionList').append($('<option selected="selected">Select an Item</option>'));
    alert('ARR IMMU'+arr);
    $conditions.forEach(function(item){
      //alert(JSON.stringify(algs));
      if(item != null && !(arr.indexOf(item.Value) > -1)){
        var op = $('<option>');
        var al = item.Value;
        op.attr('value',al);
        console.log(al+' AL');
        op.html(al);
        $('#conditionList').append(op);
    }
    });//end of for each
    // When the user clicks the button, open the modal
    alert('make block');
    document.getElementById('myModal').style.display = "block";

  });

});
