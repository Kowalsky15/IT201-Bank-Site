<?php

include ( "myfunctions.php" );
include ( "account.php" );
session_start();

($dbh = mysql_connect ( $hostname, $username, $password) )
or die ( "Unable to connect to MySQL database" );
mysql_select_db($project);

$amount = $_GET["amount"];
$transaction = $_GET["transaction"];
$username = $_SESSION["NAME"];
$loggedin = $_SESSION["LOGGED_IN"];
$type = $_SESSION["STATE"];
$cbalance = $_SESSION["CURRENT_BALANCE"];

print "Name: $username<br>";
$cblist = "select current_balance from Accounts where user = '$username'";
($c = mysql_query($cblist)) or die (mysql_error());
while ($x = mysql_fetch_array($c)) 
    {
	$cb = $x["current_balance"];
	print "Current Balance: <b>$cb</b><br>";
	}
gatekeeper ($loggedin, $type, "user");
update ($username, $amount, $transaction, $cbalance);

if ( !isset ($_GET["email"]) ) die ("<br>No mail requested");
if ( isset ($_GET["email"]) ) {
	$to = $_SESSION["email"];
	$subject = "Account information";
	$message = "Transaction for user: $username <br> Type: $type<br> Amount: $amount <br> Current balance: $cbalance ";
	mail ($to, $subject, $message);
	echo "<br>Mail Sent.";	
}

?>