<?php
session_start();
$currentuser = $_SESSION['username'];


$db = mysqli_connect('mysql.metropolia.fi', 'mikkooke', 'Juhani99', 'mikkooke');

$query = "SELECT userid FROM users WHERE username = '$currentuser'";
$result = $db->query($query);
$id = mysqli_fetch_array($result);

$result = $db->query("SELECT weight FROM calorycalc2 WHERE userid = $id[0]");

$dbdata = array();
 while ( $row = $result->fetch_assoc())  {
  $dbdata[]=$row;
  }

$data = json_encode($dbdata);
echo $data;