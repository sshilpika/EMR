<?php
try
{
  $pdo = new PDO('mysql:host=localhost;dbname=emr', 'root', 'root08');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  $error = 'Unable to connect to the database server.';
  include 'error.inc.php';
  exit();
}


echo 'hello this is from includes file in the root directory'

?>
