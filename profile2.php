<?php

error_reporting(0);
ini_set('display_errors', 0);
session_start();
$currentuser = $_SESSION['username'];

$db = mysqli_connect('mysql.metropolia.fi', 'mikkooke', 'Juhani99', 'mikkooke');

$query = "SELECT userid FROM users WHERE username = '$currentuser'";
$result = $db->query($query);
$id = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
    <title>Profile</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/progress.css">
  <style>

.container2 {
  margin: 40px;
}

input[type=text], select {
  width: 100%;
  padding: 12px 0px;
  margin: 12px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #406efd;;
  color: white;
  padding: 14px 20px;
  margin: 18px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #405efd;;
}

form {
  margin-top: 100px;
}

label {
  margin-bottom: 0px;
  font-weight: 600;
}

.btn{
margin-top: 10px;
margin-left: 0;
margin-right:20px; 
}
.navbar>.container{
    display: inline;
  }
.vari {
  background-color: red;
  border-color: red;
}
.vari:hover {
  background-color: darkred;
  border-color: darkred;
}  
.jotain {
  margin-right: 28%;
}
@media screen and (max-width: 800px) {
  .btn {
    width: 100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
</style>
</head>

<body>
<!-- Navigation -->
  <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="index2.php">FatLess</a>
      <a class="btn btn-primary" href="index2.php">Homepage</a>
      <a class="btn btn-primary" href="profile2.php">Profile</a>
      <a class="btn btn-primary" href="calc.php">Calorie counter</a>
      <a class="btn btn-primary" href="progress.php">Progress</a>
      <a class="btn btn-primary jotain" href="training.html">Training tips</a>
    
  
          <a class="btn btn-primary vari" href="index.html">Sign Out</a>
        </div>
  </nav>


<div class="container2">
  <h1> Profile </h1>


<?php
$query = "SELECT * FROM calorycalc2 WHERE userid = $id[0]";
$result1 = mysqli_query($db, $query) or die(mysqli_error());

$array = array();

while($row = mysqli_fetch_assoc($result1)) {
   $array[] = $row;
}


$activity = $array[0]['activity'];
if ($activity==1.20) {
  $activity = "Sedentary";
}

if ($activity==1.30) {
  $activity = "Moderate";
}

else {
  $activity = "Active";
}

$activity2 = end($array)['activity'];
if ($activity2==1.20) {
  $activity2 = "Sedentary";
}

if ($activity2==1.30) {
  $activity2 = "Moderate";
}

else {
  $activity2 = "Active";
}





if (mysqli_num_rows($result1)!=0) {
echo "Here is your information <br> <strong> Be aware </strong> that you have to start all over if you change these information";
print("<br>");
print("<br>");
}
else {
  echo "Hello, click the following link to get started";
}


if (mysqli_num_rows($result1)!=0) {
echo "<strong> Starting weight: </strong>" . $array[0]['weight'] . " kg" . " -------->" . "<strong> Current weight: </strong>" . end($array)['weight'] . " kg";
print("<br>");
echo "<strong> Starting activity : </strong>" . $activity . "-------->" . "<strong> Current activity: </strong>" . $activity2;
print("<br>");
echo "<strong> Starting goal: </strong>" . $array[0]['goal'] . " weight" . "-------->" . "<strong> Current goal: </strong>" . end($array)['goal'] . " weight";
print("<br>");
echo "<strong> Starting monthly goal :</strong> " . $array[0]['goal'] . " " . $array[0]['month']. " kg" . "-------->" . "<strong> Current monthly goal :</strong> " . end($array)['goal'] . " " . end($array)['month'] . " kg" ;
print("<br>");
}
$query = "SELECT * FROM users WHERE userid = $id[0]";
$result2 = mysqli_query($db, $query) or die(mysqli_error());

$array = array();

while($row = mysqli_fetch_assoc($result2)) {
   $array[] = $row;   
}
if (mysqli_num_rows($result1)!=0) {
echo "<strong> Gender : </strong>" .$array[0]['gender'];
print("<br>");
echo "<strong> Height : </strong>" .$array[0]['height'];
print("<br>");
echo "<strong> Birthdate : </strong>" .$array[0]['date'];
}
print("<br>");
print("<br>");

if (mysqli_num_rows($result1)==0) :
?>

<a class="btn btn-primary" href="profile.php">Fill information</a>

<?php endif ?>

<?php
if (mysqli_num_rows($result1)!=0) :
?>

<a class="btn btn-primary" href="newprofile.php">Change information</a>

<?php endif ?>

</div>

</body>
</html>


