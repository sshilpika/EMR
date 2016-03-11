var express = require('express');
var app = express();
app.use("/css", express.static(__dirname + '/css'));
app.use("/physician/css", express.static(__dirname + '/physician/css'));
app.use("/physician/js", express.static(__dirname + '/physician/js'));
app.use("/physician/tab-content", express.static(__dirname + '/physician/tab-content'));
app.use("/physician/tab-content/template1/tabcontent.css", express.static(__dirname + '/physician/tab-content/template1/tabcontent.css'));


app.get('/say_hello', function (req, res) {
   res.sendFile( __dirname + "/physician/" + "patient-table.html" );
})

app.get('/login.html',function(req, res){
  res.sendFile( __dirname + "/" + "login.html" );
})

var server = app.listen(8082, function () {

  var host = server.address().address
  var port = server.address().port

  console.log("Example app listening at http://%s:%s", host, port)

})
