<?php
session_start();
$currentuser = $_SESSION['username'];
$db = mysqli_connect('mysql.metropolia.fi', 'mikkooke', 'Juhani99', 'mikkooke');

$query = "SELECT userid FROM users WHERE username = '$currentuser'";
$result = $db->query($query);
$row = mysqli_fetch_array($result);



$query = "SELECT energy FROM calorycalc2 WHERE userid = $row[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$row = mysqli_fetch_array($result);


$userid = $_SESSION['username'];
$age = mysqli_real_escape_string($db, $_POST['age']);
$weight = mysqli_real_escape_string($db, $_POST['weight']);
$height = mysqli_real_escape_string($db, $_POST['height']);


if(isset($_POST['gender'])){
$gender = mysqli_real_escape_string($db, $_POST['gender']);
}


if(isset($_POST['activity'])){
$activity = mysqli_real_escape_string($db, $_POST['activity']);
}


if ($activity == "sedentary") {
    $activity = 1.2;
}

if ($activity == "moderate") {
    $activity = 1.3;
}

if ($activity == "active") {
    $activity = 1.4;
}


if ($gender == "female") {
  $value = 10 * $weight  + 6.25 * $height - 5 * $date2 - 161;
  $value = $value * $activity;
} 
if ($gender == "male") {
  $value = 10 * $weight + 6.25 * $height - 5 * $date2 + 5;
  $value = $value * $activity;
}


$kakka = "jeejee";
?>