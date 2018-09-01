<?php

include ( "myfunctions.php" );
include ( "account.php" );
session_start();

($dbh = mysql_connect ( $hostname, $username, $password) ) or die ( "Failed to MySQL database" );
mysql_select_db($project);

$username = $_SESSION["NAME"];
$loggedin = $_SESSION["LOGGED_IN"];
$type = $_SESSION["STATE"];

gatekeeper($loggedin, $type, "administrator");
sql ($type, $name, $a, $t);
echo $s1;
$out1 = get_A($type, $a);
print $out1;
$out1 = get_T( $type, $t);
print $out1;

?>