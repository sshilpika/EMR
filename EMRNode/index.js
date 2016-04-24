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
var atob = require('atob');

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


app.post('/patient_information', function (req, res) {
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
                console.log('USER TYPE::'+req.body.loginas);
                console.log('1 ',rows);
                var userType = req.body.loginas;
                if(userType =="doctor" || userType =="pharmacist"){
                  res.render('patient-table',{result: rows,type:{type:'doctor'}});
                }else if (userType =="patient") {
                  patientDetails(pass[0].SSN,userType,res);
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

function patientDetails(ssn,userType,res){
  var demog_query = 'SELECT First_Name, Last_Name, Gender, Birth_Date, SSN, Home_Address, City, State, ZipCode, Home_Phone FROM Person WHERE SSN = ?'
  connection.query(demog_query,[ssn], function(err, rows, fields) {
    if (!err){
      console.log('DEMO1 ',rows);
      res.render('patient-demographics',{layout:'patient-info' ,result:rows[0],type:{type:userType}});
      console.log('2 ',rows[0].First_Name);
    }else
      console.log(err);
    });
}

app.get('/patient-details',function(req,res){
  var ssn = atob(req.query.id);
  console.log("PATIENT_DETAILS SSN --->"+ssn);
  patientDetails(ssn,req.query.userType,res);

})

app.get('/patient-precond',function(req,res){
    console.log('inside patient pre conditions');
    var userType = req.query.userType;
    var pre_query = 'SELECT patient.EntryDate, pre.Value FROM PreExistingConditions pre, PatientsPreConditions patient WHERE patient.P_SSN = ? AND pre.Id = patient.PreConditionId ORDER BY patient.EntryDate DESC';

    connection.query(pre_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        if(userType =='patient'){
          res.render('patient-views/patient-preconditions',{layout:'pre-condition-lay' ,result:rows});
        }else {
            res.render('doctor-views/patient-preconditions',{layout:'pre-condition-lay' ,result:rows});
          }
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})

app.get('/patient-allergies',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT patient.EntryDate, allergies.Value FROM Allergies allergies, PatientsAllergies patient WHERE patient.P_SSN = ? AND allergies.Id = patient.AllergyId ORDER BY patient.EntryDate DESC';
    var userType = req.query.userType;
    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        if(userType =='patient'){
          res.render('patient-views/patient-allergies',{layout:'allergies-lay' ,result:rows});
        }else {
            res.render('doctor-views/patient-allergies',{layout:'allergies-lay' ,result:rows});
          }

       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})

app.get('/patient-medications',function(req,res){
    console.log('inside patient medications');
    var allergy_query = 'SELECT meds.MedicineName FROM Medications meds WHERE meds.P_SSN =? ORDER BY meds.EntryDate DESC';
    var userType = req.query.userType;
    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        if(userType =='patient'){
            res.render('patient-views/patient-medications',{layout:'meds-lay' ,result:rows});
        }else {
            res.render('doctor-views/patient-medications',{layout:'meds-lay' ,result:rows});
          }
       console.log('2 ',rows[0]);
      }else
        console.log(err);
      });

})
app.get('/patient-immunizations',function(req,res){
    console.log('inside patient allergies');
    var allergy_query = 'SELECT Value FROM Immunizations WHERE Id IN(SELECT ImmunizationId FROM PatientsImmunizations WHERE P_SSN =?)';
    var userType = req.query.userType;
    connection.query(allergy_query,[req.query.ssn], function(err, rows, fields) {
      if (!err){
        console.log('1 ',rows);
        if(userType =='patient'){
            res.render('patient-views/patient-immunizations',{layout:'immunization-lay' ,result:rows});
        }else {
            res.render('doctor-views/patient-immunizations',{layout:'immunization-lay' ,result:rows});
          }
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
  var userType = req.query.userType;
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
        if(userType =='patient'){
            res.render('patient-views/patient-visits',{layout:'visits-lay' ,result:rows});
        }else {
            res.render('doctor-views/patient-visits',{layout:'visits-lay' ,result:rows});
          }
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

app.get('/getPreConditions',function(req,res){
  console.log('get all allergies');
  var allergies_query ="SELECT Value FROM PreExistingConditions ORDER BY Value";
  connection.query(allergies_query,function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/getMedications',function(req,res){
  console.log('get all allergies');
  var allergies_query ="SELECT MedicineName FROM Medications ORDER BY MedicineName";
  connection.query(allergies_query,[req.query.ssn],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/getImmunizations',function(req,res){
  console.log('get all allergies');
  var allergies_query ="SELECT Value FROM Immunizations ORDER BY Value";
  connection.query(allergies_query,[req.query.ssn],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/getCurrentStat',function(req,res){
  console.log('get all allergies');
  var allergies_query ="SELECT patient.Current_Status FROM Patient patient WHERE patient.SSN =?";
  connection.query(allergies_query,[req.query.ssn],function(err, rows, fields) {
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

app.get('/deletePreCondition',function(req,res){
  console.log('get all allergies');
  var allergies_query ="DELETE FROM PatientsPreConditions WHERE P_SSN =? AND PreConditionId = (SELECT Id FROM PreExistingConditions WHERE Value =?)";
  connection.query(allergies_query,[req.query.ssn,req.query.al],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/deleteMedication',function(req,res){
  console.log('get all allergies');
  var allergies_query ="DELETE FROM Medications WHERE P_SSN =? AND MedicineName =?";
  connection.query(allergies_query,[req.query.ssn,req.query.al],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/deleteImmunizations',function(req,res){
  console.log('get all allergies');
  var allergies_query ="DELETE FROM PatientsImmunizations WHERE P_SSN =? AND ImmunizationId = (SELECT Id FROM Immunizations WHERE Value =?)";
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

app.get('/addPreCond',function(req,res){
  console.log('get all allergies');
  var allergies_query ="INSERT INTO PatientsPreConditions(P_SSN, PreConditionId, EntryDate) VALUES(?, (SELECT Id FROM PreExistingConditions WHERE Value =?), now())";
  connection.query(allergies_query,[req.query.ssn,req.query.al],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/addMedications',function(req,res){
  console.log('get all allergies');
  var allergies_query ="INSERT INTO Medications(P_SSN, MedicineName, EntryDate) VALUES(?,?, now())";
  connection.query(allergies_query,[req.query.ssn,req.query.al],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/addImmunizations',function(req,res){
  console.log('get all allergies');
  var allergies_query ="INSERT INTO PatientsImmunizations(P_SSN, ImmunizationId, EntryDate) VALUES(?, (SELECT Id FROM Immunizations WHERE Value =?), now())";
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

app.get('/savePreCondEdit',function(req,res){
  console.log('save all allergies');
  var allergies_query ="UPDATE "+
            "PatientsPreConditions "+
          "SET "+
            "PreConditionId = (SELECT Id FROM PreExistingConditions WHERE Value =?), "+
            "EntryDate = now()  "+
          "WHERE "+
            "P_SSN =? "+
          "AND "+
          "  PreConditionId "+
          "IN "+
            "(SELECT Id FROM PreExistingConditions WHERE Value =?)";
  connection.query(allergies_query,[req.query.al2,req.query.ssn,req.query.al1],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/saveMedicationsEdit',function(req,res){
  console.log('save all allergies');
  var allergies_query ="UPDATE "+
            "Medications "+
          "SET "+
          "  MedicineName =?, "+
            "EntryDate = now() "+
          "WHERE "+
          "  P_SSN =? "+
          "AND "+
          "  MedicineName =?";
  connection.query(allergies_query,[req.query.al2,req.query.ssn,req.query.al1],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/saveImmunizationsEdit',function(req,res){
  console.log('save all allergies');
  var allergies_query ="UPDATE "+
            "PatientsImmunizations "+
          "SET "+
            "ImmunizationId = (SELECT Id FROM Immunizations WHERE Value =?), "+
            "EntryDate = now()  "+
          "WHERE "+
            "P_SSN =? "+
          "AND "+
          "  ImmunizationId "+
          "IN "+
            "(SELECT Id FROM Immunizations WHERE Value =?)";
  connection.query(allergies_query,[req.query.al2,req.query.ssn,req.query.al1],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/saveCurrentStatEdit',function(req,res){
  console.log('save all allergies');
  var allergies_query ="UPDATE Patient SET Current_Status =? WHERE SSN=?";
  connection.query(allergies_query,[req.query.al2,req.query.ssn],function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})
//Add new visit changes

function executeQuery0(query){
  connection.query(query,function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      return rows;
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });
}

function executeQuery1(query,ssn){
  connection.query(query,[ssn],function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      return rows;
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });
}

app.get('/getVisitCount',function(req,res){
  var query = "SELECT COUNT(*) AS 'Count' FROM Visit";
  connection.query(query,function(err, rows, fields) {
    if (!err){
      console.log('allergies all ',rows);
      res.json(rows[0]);
     console.log('allergies row 1 ',rows[0]);
    }else
      console.log(err);
    });
})

app.get('/getBillCount',function(req,res){
  var query = "SELECT COUNT(*) AS 'Count' FROM Bill";
  connection.query(query,function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows[0]);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.get('/getPhysicianName',function(req,res){
  var query = "SELECT CONCAT(First_Name, ' ', Last_Name) AS 'Name' FROM Person person WHERE SSN =("+
            "SELECT D_SSN FROM Patient WHERE SSN =?)";
  var ssn = decodeURIComponent(req.query.id);
  console.log('PHYSICIAN SSN'+ssn);
  connection.query(query,[ssn],function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows[0]);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.get('/getDiagnosisList',function(req,res){
  var query = "SELECT Diagnosis_Category FROM Diagnosis";
  connection.query(query,function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.get('/getMedicineList',function(req,res){
  var query = "SELECT Mname FROM Medicine";
  connection.query(query,function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.get('/getDocSSN',function(req,res){
  var query = "SELECT SSN FROM Person WHERE CONCAT(First_Name, ' ', Last_Name) =?";
  connection.query(query,[req.query.dName],function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.post('/addToVisit',function(req,res){
  var query = "INSERT INTO Visit(Visit_ID, Date_Time,D_SSN, Bill_Num, CommentsSuggestions, Complaint) VALUES (?,now(),?,?,?,?)";
  console.log('params'+[req.body.visitid,req.body.dSSN,req.body.billNum,req.body.comments,req.body.complaints]);
  connection.query(query,[req.body.visitid,req.body.dSSN,req.body.billNum,req.body.comments,req.body.complaints],function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.post('/addToHasVisits',function(req,res){
  var query = "INSERT INTO Has_Visits(P_SSN, Visit_ID) VALUES (?,?)";
  console.log('params'+[req.body.pSSN,req.body.visitid]);
  connection.query(query,[req.body.pSSN,req.body.visitid],function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.post('/addToResults',function(req,res){
  var query = "INSERT INTO Result(Visit_ID, Diagnosis_ID) VALUES (?,(SELECT Diagnosis_ID FROM Diagnosis WHERE Diagnosis_Category =?))";
  console.log('params'+[req.body.visitId,req.body.diagnosisName]);
  connection.query(query,[req.body.visitId,req.body.diagnosisName],function(err, rows, fields) {
    if (!err){
      console.log('DB Results ',rows);
      res.json(rows);
     console.log('DB Result 1 ',rows[0]);
    }else
      console.log(err);
    });

})
app.get('/getPrescriptionId',function(req,res){
  var query = "SELECT count(*) AS 'RxId' FROM Prescription";
  connection.query(query,function(err, rows, fields) {
    if (!err){
      console.log('RXID ',rows);
      res.json(rows);
     console.log('RXID 1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.get('/addToPrescribedMeds',function(req,res){
  var query = "INSERT INTO Prescribed_Meds(Prescription_ID, Minventory_ID, Medicine_Quantity) VALUES (?,(SELECT Minventory_ID FROM Medicine WHERE Mname =?),?)";
  connection.query(query,[req.query.rxid,req.query.medname,req.query.medquan],function(err, rows, fields) {
    if (!err){
      console.log('DB Results Prescribed_Meds',rows);
      res.json(rows);
     console.log('DB Result Prescribed_Meds1 ',rows[0]);
    }else
      console.log(err);
    });

})

app.get('/addToPrescriptions',function(req,res){
  var query = "INSERT INTO Prescription(Prescription_ID, Visit_ID, PH_SSN) VALUES (?,?,?)";
  connection.query(query,[req.query.rxid,req.query.visitid,req.query.phid],function(err, rows, fields) {
    if (!err){
      console.log('DB Results Prescription',rows);
      res.json(rows);
     console.log('DB Result Prescription 1 ',rows[0]);
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
