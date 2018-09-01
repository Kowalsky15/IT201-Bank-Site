<?php

include ( "myfunctions.php" );
include ( "account.php" );
session_start();
( $dbh = mysql_connect ( $hostname, $username, $password ) )
       or die ( "Failed to connect to MySQL database" );
mysql_select_db($project);
       
$name = $_GET["user"];
$pass = $_GET["pass"];
$type = $_GET["type"];

$sname = mysql_real_escape_string($name);
$spass = mysql_real_escape_string($pass);

if ($type == "user"){
  user($name, $pass, $cbalance);
  $_SESSION["NAME"] = $name;
  $_SESSION["STATE"] = $type;
  $_SESSION["LOGGED_IN"] = true;
  $_SESSION["CURRENT_BALANCE"] = $cbalance;
  redirect ("Valid credentials, redirecting to user page", "user.php");
  exit();
}

if ($type == "administrator"){
  admin($name, $pass);
  $_SESSION["NAME"] = $name;
  $_SESSION["STATE"] = $type;
  $_SESSION["LOGGED_IN"] = true;
  redirect ("Valid credentials, redirecting to administrator page", "admin.php");
  exit();
}
  
?>