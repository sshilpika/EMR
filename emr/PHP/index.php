<?php 
include_once $_SERVER['DOCUMENT_ROOT'].'/ProjectMe/includes/db.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/ProjectMe/includes/access.inc.php';
echo userIsLoggedIn();
if(userIsLoggedIn()){
include 'login.html.php';
exit();
}

