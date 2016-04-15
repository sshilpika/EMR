var express    = require('express');
var app        = express();
var handlebars = require('express3-handlebars').create({ defaultLayout: 'main' ,helpers: {section: function(name, options){ if(!this._sections) this._sections = {}; this._sections[name] = options.fn(this); return null;} }});
var mongoose   = require('mongoose'),
    db         = mongoose.createConnection('localhost', 'EMR');
var bcrypt = require('bcrypt-nodejs');

db.on('error', console.error.bind(console, 'connection error:'));

app.engine('handlebars', handlebars.engine);
app.set('view engine', 'handlebars');
app.use(require('body-parser')());
app.use("/css", express.static(__dirname + '/css'));

app.get("/", function(req,res){
  var hash = bcrypt.hashSync("pass123");
  var first = bcrypt.compareSync("pass123", hash); // true
  var second = bcrypt.compareSync("veggies", hash); // false
  res.send(hash + "__" + first + "__" + second);
});


var server = app.listen(8083, function () {

  var host = server.address().address
  var port = server.address().port

  console.log("Example app listening at http://%s:%s", host, port)

})
