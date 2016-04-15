var oldValue = '';
$(document).on('click','button.allergy-edit',function(){
    oldValue = this.parentNode.textContent.split("\n")[1].trim();
    var $deferredAllergies = $.getJSON('getAllergies');
    $.when($deferredAllergies).done(function(response){
      console.log(JSON.stringify(response));
      $allergies = response;
      $('#allergyList').empty();
      $('#allergyList').append($('<option selected="selected">Select an Item</option>'));
      $allergies.forEach(function(item){
        if(item != null && item.Value != oldValue){
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
  var allergy = $('#allergyList option:selected').text();
  var ssn = $('#ssn').text();
  alert(allergy);
  var $deferredAlSave = $.getJSON('saveAllergyEdit?al1='+oldValue+'&ssn='+ssn+'&al2='+allergy);
  $deferredAlSave.done(function(response){
    console.log(JSON.stringify(response));
    var p =$('<p>');
    p.html('Allergy changes saved');
    p.hide();
    document.getElementById('myModal').style.display = "none";
    $('#edit-message').append(p);
    p.fadeIn('slow');
  });

  $deferredAlSave.fail(function(response){
    console.log(JSON.stringify(response));
    var p =$('<p>');
    p.html('Failed to save changes. Please try again.');
    p.hide();
    document.getElementById('myModal').style.display = "none";
    $('#edit-message').append(p);
    p.fadeIn('slow');
  });
});
