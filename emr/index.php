<?php


include $_SERVER['DOCUMENT_ROOT'].'/emr/includes/access.inc.php';

if (!userIsLoggedIn())
{
  include 'login.html.php';
  exit();
}


if (isset($_POST['loginas']) or $_POST['loginas'] != '' or  isset($_SESSION['loginas']) or $_SESSION['loginas'] !='')
{
$loginas = $_SESSION['loginas'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];

if($_POST['loginas'] == 'patient' or $_SESSION['loginas'] =='patient'){
  include '/patient/index.php';
}
else if($_POST['loginas'] == 'doctor'){
	include '/physician/index.php';
}
else if($_POST['loginas'] == 'pharmacist'){
	include '/pharmacist/index.php';

}else{
	include 'login.html.php';
	exit();

}
  
}


