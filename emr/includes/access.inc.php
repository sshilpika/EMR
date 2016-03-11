<?php
require 'lib/password.php';

function userIsLoggedIn()
{

  if (isset($_POST['action']) and $_POST['action'] == 'login')
  {
    if (!isset($_POST['username']) or $_POST['username'] == '' or !isset($_POST['loginas']) or $_POST['loginas'] == '' or
      !isset($_POST['password']) or $_POST['password'] == '')
    {
      $GLOBALS['loginError'] = 'Please fill in all the fields below';
      return FALSE;
    }

    //$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
	$password = $_POST['password'];
    if (databaseContainsPerson($_POST['username'], $password, $_POST['loginas']))
    {
      session_start();
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['password'] = $password;
	  $_SESSION['loginas'] = $_POST['loginas'];
      return TRUE;
    }
    else
    {
      session_start();
      unset($_SESSION['loggedIn']);
      unset($_SESSION['username']);
      unset($_SESSION['password']);
	  unset($_SESSION['loginas']);
      $GLOBALS['loginError'] =
          'The specified username, usertype or password was incorrect.';
      return FALSE;
    }
  }
//echo $_POST['action'];
  if (isset($_POST['action']) and $_POST['action'] == 'logout')
  {
 // echo 'in logout ';
    session_start();
    unset($_SESSION['loggedIn']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
	unset($_SESSION['loginas']);
    header('Location: ' . $_POST['goto']);
    exit();
  }

  session_start();
  if (isset($_SESSION['loggedIn']))
  {
    return databaseContainsPerson($_SESSION['username'], $_SESSION['password'], $_SESSION['loginas']);
  }
}

function databaseContainsPerson($username, $password, $loginas)
{
  include 'db.inc.php';

  try
  {
    $sql = 'SELECT password FROM '.$loginas.'
        WHERE username = :username';
		//echo $sql.' database contains function '.$username;
    $s = $pdo->prepare($sql);
    $s->bindValue(':username', $username);
    //$s->bindValue(':password', $password);
    $s->execute();
  }
  catch (PDOException $e)
  {
    $error = 'Error searching for user.'.$sql.$username;
    include 'error.html.php';
    exit();
  }
	
  $row = $s->fetch();
//echo $sql;
//echo $username;
//echo $password.'\n';
//echo $row[0].'    ';
  if ($row[0] != '')
  {
  $user = $row[0];
  //echo 'MATCHES   ';
 // echo password_verify( $password, $user );
  $matches = password_verify( $password, $user);
  //echo $matches;
	if( !$matches ) 
	{
		return FALSE;
    }
	return TRUE;
  }
  else
  {
    return FALSE;
  }
  
}


