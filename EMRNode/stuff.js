var mysql      = require('mysql');
var connection = mysql.createConnection({
  host     : '127.0.0.1',
  port: 3306,
  user     : 'root',
  password : 'root08',
  database : 'EMR'
});

connection.connect(function(err){
  if(err){
    console.log('Error connecting to Db');
    return;
  }
  console.log('Connection established');
});
var k = 'DLily'
connection.query('SELECT * from Doctor Where username = ?',[k], function(err, rows, fields) {
  if (!err)
    console.log('The solution is: ', rows);
  else
    console.log(err);
});

connection.end();


// boilerplate code
//allergies
$('#v3').one("click",function() {
    $.get('/patient-allergies?ssn='+$('#ssn').text(), function(list) {
        $('div.allergies').html(list); // show the list

    });
});
// medications
$('#v4').one("click",function() {
    $.get('/patient-medications?ssn='+$('#ssn').text(), function(list) {
        $('div.medications').html(list); // show the list

    });
});
//Immunizations
$('#v5').one("click",function() {
    $.get('/patient-immunizations?ssn='+$('#ssn').text(), function(list) {
        $('div.immunizations').html(list); // show the list

    });
});
//Current status
$('#v6').one("click",function() {
    $.get('/patient-currentstat?ssn='+$('#ssn').text(), function(list) {
        $('div.currentstat').html(list); // show the list

    });
});
//Visits
$('#v7').one("click",function() {
    $.get('/patient-visits?ssn='+$('#ssn').text(), function(list) {
        $('div.visits').html(list); // show the list

    });
});
//prescriptions
$('#v8').one("click",function() {
    $.get('/patient-prescriptions?ssn='+$('#ssn').text(), function(list) {
        $('div.prescriptions').html(list); // show the list

    });
});
//Notes
$('#v9').one("click",function() {
    $.get('/patient-notes?ssn='+$('#ssn').text(), function(list) {
        $('div.notes').html(list); // show the list

    });
});
