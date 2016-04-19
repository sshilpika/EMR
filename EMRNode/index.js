var express         = require('express');
var databaseResults = require('./lib/connection.js')
var app             = express();
var moment = require('moment');
var handlebars      = require('express3-handlebars').create({
  defaultLayout: 'main' ,
  helpers: {
    section: function(name, options){
       if(!this._sections) this._sections = {};
       this._sections[name] = options.fn(this);
       return null;},
     formatDate: function (date, format) {
          return moment(date).format(format);
      }
     }
   });
var mysql           = require('mysql');
var mongoose        = require('mongoose');
var bcrypt          = require('bcrypt-nodejs');

var connection = mysql.createConnection({
  host     : '127.0.0.1',
  port     : 3306,
  user     : 'root',
  password : 'root0808',
  database : 'EMR'
});

app.engine('handlebars', handlebars.engine);
app.set('view engine', 'handlebars');
app.use(require('body-parser')());
app.use(require('connect-flash')());
app.use("/css", express.static(__dirname + '/css'));
app.use("/physician/css", express.static(__dirname + '/physician/css'));
app.use("/physician/js", express.static(__dirname + '/physician/js'));
app.use("/physician/tab-content", express.static(__dirname + '/physician/tab-content'));


app.post('/say_hello', function (req, res) {
  console.log(req.body.username+" "+req.body.password+" "+req.body.loginas );

  connection.connect(function(err){
    if(err){
      console.log('Error connecting to Db');
      return;
          }
    console.log('Connection established');
    });


  connection.query('SELECT password, SSN FROM '+req.body.loginas+' WHERE username =? ',[req.body.username],function(err, pass, fields){


      if (!err){
        if(typeof pass[0] != 'undefined' && bcrypt.compareSync(req.body.password, pass[0].password)){
            console.log('Getting patient info for doctor...');
            connection.query('SELECT person.SSN,'+
                              		'person.First_Name, '+
                              		'person.Last_Name, '+
                              		'person.Birth_Date, '+
                              		'person.Gender, '+
                              		'patient.Current_Status '+
                              	'FROM Person person, Patient patient '+
                              	'WHERE patient.D_SSN =? AND patient.SSN = person.SSN',[pass[0].SSN], function(err1, rows, fields) {
              if (!err1){
                console.log('1 ',rows);
                if(req.body.loginas =="doctor" || req.body.loginas =="pharmacist"){
                  res.render('patient-table',{result: rows});
                }else if (req.body.loginas =="patient") {
                  patientDetails(pass[0].SSN,res);
                }else{
                  res.redirect('/login.html?e=' + encodeURIComponent('Incorrect username or password. Please try again.'));
                  console.log('Invalid details');
                }

              }else
                console.log(err1);
              });
          }else{
            res.redirect('/login.html?e=' + encodeURIComponent('Incorrect username or password. Please try again.'));
            console.log('Invalid details');
          }
    }else{
      res.redirect('/login.html?e=' + encodeURIComponent('Incorrect username or password. Please try again.'));
      console.log('Invalid details:'+err);
    }
  })

})

function patientDetails(ssn,res){
  var demog_query = 'SELECT First_Name, Last_Name, Gender, Birth_Date, SSN, Home_Address, City, State, ZipCode, Home_Phone FROM Person WHERE SSN = ?'
  connection.query(demog_query,[ssn], function(err, rows, fields) {
    if (!err){
      console.log('DEMO1 ',rows);
      res.render('patient-demographics',{layout:'patient-info' ,result:rows[0]});
     console.log('2 ',rows[0].First_Name);
    }else
      console.log(err);
    });
}

app.get('/patient-details',function(req,res){
  patientDetails(req.query.ssn,res);

})

app.get('/patient-precond',function(req,res){
    console.log('inside patient pre conditions');
    var pre_query = 'SELECT patient.EntryDate, pre.Value FROM PreExistingConditions pre, PatientsPreConditions patient WHERE patient.P_SSN = ? AND pre.Id = patient.PreConditionId ORDER BY patient.EntryDate DESC';

    connection.query(pre_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-preconditions',{layout:'pre-condition-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})

app.get('/patient-allergies',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT patient.EntryDate, allergies.Value FROM Allergies allergies, PatientsAllergies patient WHERE patient.P_SSN = ? AND allergies.Id = patient.AllergyId ORDER BY patient.EntryDate DESC';

    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-allergies',{layout:'allergies-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})

app.get('/patient-medications',function(req,res){
    console.log('inside patient medications');
    var allergy_query = 'SELECT meds.MedicineName FROM Medications meds WHERE meds.P_SSN =? ORDER BY meds.EntryDate DESC';

    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-medications',{layout:'meds-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})
app.get('/patient-immunizations',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT Value FROM Immunizations WHERE Id IN(SELECT ImmunizationId FROM PatientsImmunizations WHERE P_SSN =?)';

    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-immunizations',{layout:'immunization-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });
})
app.get('/patient-currentstat',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT '+
              'patient.Current_Status '+
              'FROM '+
              'Patient patient '+
             'WHERE '+
              'patient.SSN = ?';

    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-currentstat',{layout:'currentstat-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

  //connection.end();

})

app.get('/patient-visits',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT '+
              'Date_Time '+
            'FROM '+
            '  Visit '+
            'WHERE '+
            '  Visit_ID '+
            'IN '+
            '  ('+
            '    SELECT '+
            '      Visit_ID '+
            '    FROM '+
            '      Has_Visits '+
            '    WHERE '+
            '      P_SSN = ? '+
            '  )              '+
            'ORDER BY '+
            '  Date_Time DESC';

    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-visits',{layout:'visits-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})

app.get('/visitsByDate',function(req,res){
    console.log('inside patient visit by date');

    var allergy_query = "SELECT Visit_ID, physician.First_Name, physician.Last_Name, Bill_Num, CommentsSuggestions, Complaint FROM Visit visit, Person physician WHERE Date_Time = ? AND visit.D_SSN = physician.SSN";
    var date = new Date(req.query.date);
    console.log('VVVVV'+date);
    connection.query(allergy_query,[date], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.json(rows);
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });
})

app.get('/getPatientNotes',function(req,res){
  console.log('inside patient notes by date');
  var date = new Date(req.query.date);
  var p_notes_query = 'SELECT Comments FROM Notes WHERE P_SSN =? AND EntryDate =?';
  connection.query(p_notes_query,[req.query.ssn, date], function(err, rows, fields) {
    if (!err){
      console.log('1 ',rows);
      res.json(rows);
     console.log('2 ',rows[0]);
    }else
      console.log(err);
    });
})


app.get('/getDiagnosis',function(req,res){
    console.log('inside patient diagnosis by date');

    var allergy_query = "SELECT Diagnosis_Category FROM Diagnosis WHERE Diagnosis_ID IN (SELECT Diagnosis_ID FROM Result WHERE Visit_ID =?)";

    console.log('VVVVV'+req.query.visitId);
    connection.query(allergy_query,[req.query.visitId], function(err, rows, fields) {
      if (!err){
        console.log('DIAGNOSIS ROWS ',rows);
        res.json(rows);
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });
})
app.get('/getPrescription',function(req,res){
    console.log('inside prescription visit by date');

    var allergy_query = "SELECT Mname, Medicine_Quantity FROM Medicine med, Prescribed_Meds pres WHERE med.Minventory_ID = pres.Minventory_ID AND Prescription_ID = (SELECT Prescription_ID FROM Prescription WHERE Visit_ID =?)";

    connection.query(allergy_query,[req.query.visitId], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.json(rows);
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });
})


app.get('/patient-prescriptions',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT patient.EntryDate, allergies.Value FROM Allergies allergies, PatientsAllergies patient WHERE patient.P_SSN = ? AND allergies.Id = patient.AllergyId ORDER BY patient.EntryDate DESC';

    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-allergies',{layout:'allergies-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

  //connection.end();

})
app.get('/patient-notes',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT EntryDate FROM Notes WHERE P_SSN =? ORDER BY EntryDate DESC';
    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        res.render('patient-notes',{layout:'notes-lay' ,result:rows});
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})

app.get('/getAllergies',function(req,res){
  console.log('get all allergies');
  var allergies_query ="SELECT Value FROM Allergies ORDER BY Value";
  connection.query(allergies_query,function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/deleteAllergy',function(req,res){
  console.log('get all allergies');
  var allergies_query ="DELETE FROM PatientsAllergies WHERE P_SSN =? AND AllergyId = (SELECT Id FROM Allergies WHERE Value =?)";
  connection.query(allergies_query,[req.query.ssn,req.query.al],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/addAllergy',function(req,res){
  console.log('get all allergies');
  var allergies_query ="INSERT INTO PatientsAllergies(P_SSN, AllergyId, EntryDate) VALUES(?, (SELECT Id FROM Allergies WHERE Value =?), now())";
  connection.query(allergies_query,[req.query.ssn,req.query.al],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/saveAllergyEdit',function(req,res){
  console.log('save all allergies');
  var allergies_query ="UPDATE PatientsAllergies SET AllergyId = (SELECT Id FROM Allergies WHERE Value =?),"+
          "  EntryDate = now()  "+
          "WHERE "+
          "  P_SSN =?"+
          " AND "+
          "  AllergyId "+
          "IN (SELECT Id FROM Allergies WHERE Value =?)";
  connection.query(allergies_query,[req.query.al2,req.query.ssn,req.query.al1],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})


app.get('/login.html',function(req, res){
  res.sendFile( __dirname + "/" + "login.html" );
})

var server = app.listen(8082, function () {

  var host = server.address().address
  var port = server.address().port

  console.log("Example app listening at http://%s:%s", host, port)

})
