<?php

function get_case ($name, $pass, $type){
  if ($name == null) { redirect ("Empty username", "login.html");
  }  
  if ($pass == null) { redirect ("Empty password", "login.html");
  }
}

function redirect ($m, $u){
  echo $m;
  header ("Refresh: 3; '$u' ");
}

function gatekeeper ($loggedin, $type, $formtype){
  if ($type != $formtype){ redirect ("Not administrator, redirecting to the login page.", "login.html");
    exit();
  }
  if($loggedin != true){ redirect ("Session invalid, redirecting to the login page", "login.html");
    exit();
  }
}

function admin ($name, $pass){
  if($name != "admin" || $pass != "007"){ redirect ("Invalid administrator credentials", "login.html");
    exit();
    }
  return;
}

function user ($name, $pass, &$cbalance){
    print "User: $name";
    $allaccounts = "select * from Accounts";
    ($a = mysql_query($allaccounts)) or die (mysql_error());
    $dbCheck = false;
 
    while ($r = mysql_fetch_array($a)) {
      print "<br><br>";
      $u = $r["user"];
      $p = $r["pass"];
      if (($u == $name) && ($p == $pass)){
        $dbCheck = true;
      }  
    }
    if ($dbCheck == false){ redirect ("Invalid credentials, redirecting to login page", "login.html");
      exit(); 
    }
}

function update ($name, $amount, $type) {
  $s = "insert into Transactions values ('$name', '$type', '$amount', NOW())";
  echo "<br>Transactions table updated<br>";
  mysql_query ($s) or die (mysql_error());
  echo "Transaction type: $type<br>";
  
  if ($type == 'D') {
    $new = "Update Accounts set current_balance = current_balance + '$amount' where user = '$name' ";
    echo "<br>Current balance updated<br>";
    mysql_query ($new) or die (mysql_error());
  }
 
  if ($type == 'W') {
    $new = "Update accounts set current_balance = current_balance - '$amount' where user = '$name' ";
    echo "<br>Current balance updated<br>";
    mysql_query ($new) or die (mysql_error());
  } 
}

function sql ($type, $name, &$a, &$t){
  if ($type == 'administrator')
  {
    $alist = "select * from Accounts";
    ($a = mysql_query($alist)) or die (mysql_error());
    $num = mysql_num_rows($a);
    while ($r = mysql_fetch_array($a)) 
    {
      print "<br><br>";
      $u = $r["user"];
      $pw = $r["pass"];
      $e = $r["email"];
      $fn = $r["fullname"];
      $address = $r["address"];
      $initb = $r["initial_balance"];
      $currb = $r["current_balance"];
      print "<br>User: <b>$u</b><br>";
      print "Password: <b>$pw</b><br>";
      print "Email: <b>$e</b><br>";
      print "Full Name: <b>$fn</b><br>";
      print "Address: <b>$address</b><br>";
      print "Initial Balance: <b>$initb</b><br>";
      print "Current Balance: <b>$currb</b><br>";
    } 

    $tlist = "SELECT * FROM Transactions";
    ($t = mysql_query($tlist)) or die (mysql_error());
    $num = mysql_num_rows($t);
    while ($r = mysql_fetch_array($t)) 
    {
      print "<br><br>";
      $u = $r["user"];
      $ty = $r["type"];
      $amt = $r["amount"];
      $d = $r["date"];
      print "<br>User: <b>$u</b><br>";
      print "Type: <b>$ty</b><br>";
      print "Amount: <b>$amt</b><br>";
      print "Full Name: <b>$fn</b><br>";
      print "Date: <b>$d</b><br>";
    }
  }
  else
  {
    $a = "SELECT * FROM Accounts where user='$name'";
    $t = "SELECT * FROM Transactions where user='$name'";
    print "<br>Accounts table updated: $a<br>";
    print "<br>Transactions table updated: $t<br>";
  }
}

function get_A ($a) {
  $out =  "<br> $a: $a <br>";
  ($t  = mysql_query($a)) or die (  mysql_error() );
  while ( $r = mysql_fetch_array($t) ) 
  {
    $u  = $r["user"];
    $e  = $r["email"];
    $out  .= "<br>user: $u";
    $out  .= "<br>email: $e";
  }
  return $out;
}

function get_T ($t){
  $out =  "<br> $t is: $t <br>";
  ($t  = mysql_query($t)) or die (  mysql_error() );
  while ( $r = mysql_fetch_array($t) ) 
  {
    $u  = $r["user"];
    $typ  = $r["type"];
    $amt  = $r["amount"];
    $d  = $r["date"];
    $out  .= "<br>user is $u";
    $out  .= "<br>type is $typ";
    $out  .= "<br>amount is $amt";
    $out  .= "<br>date is $d";
  }
  return $out;
}

?>