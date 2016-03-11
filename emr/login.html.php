<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login_page.css" rel="stylesheet">
    <title>Login Page</title>
 </head>
 <body>
 	<div class="wrapper">
	   <?php if (isset($loginError)): ?>
	     <p><?php echo $loginError; ?></p>
	   <?php endif; ?>
	    <form class ="form-signin" action="" method="post">
	    	<h2 class="form-signin-heading">Please login</h2>
	      <div class="form-group">
	        <label for="username">UserName: <input class="form-control" type="text" name="username"
	            id="username" placeholder="Username" required autofocus></label>
	      </div>
	      <div class="form-group">
	        <label for="password">Password: <input class="form-control" type="password"
	            name="password" id="password" placeholder="Password" required></label>
	      </div>
	      <div class="form-group">
	        <label for="loginas">Login as: 
	        	<select class="form-control" name="loginas" id="loginas" style="width: 215px" required>
				  <option disabled selected></option>
				  <option value="patient">Patient</option>
				  <option value="doctor">Doctor</option>
				  <option value="pharmacist">Pharmacist</option>
				</select></label>
	      </div>
	      <div class="form-group">
	        <input type="hidden" name="action" value="login">
	        <input type="submit" value="Log in">
	      </div>
	    </form>
	</div>
  </body>
</html>