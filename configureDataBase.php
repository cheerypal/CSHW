<?php //configures the database safely
$server = "mysql-server-1";
$user = "ejg9";
$password = "abcejg9354";
$db = "ejg9";

$con = mysqli_connect($server, $user, $password, $db);

if(!$con){
  die("connection has failed");
}
?>
