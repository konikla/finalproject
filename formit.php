<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calc</title>
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

h1,
h2,
h3,
h4,
h5,
h6 {
margin-top: 40px;
}  

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
  font-size: 17px;
  margin-top: 150px;
}

label {
  margin-bottom: 0px;
  font-weight: 600;
}
.btn{
margin-top: 10px;  
margin-left: 0px;
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
@media screen and (max-width: 800px) {
  .btn {
    width: 100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
.jotain {
  margin-right: 28%;
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
<h3>
  Recalculate your calorie need
</h3>



<?php
$expression = $_POST['weight'] and $_POST['activity'];

if (!isset($expression)) :  ?>


<div class="container2">
<div>
  <form action= "#<?php $_PHP_SELF ?>" method = "POST">
    <label>weight</label>
    <input required type="number" name="weight" placeholder="kg">

<br> <br>

<label>activity</label>
    <select id="activity" name="activity">
      <option value="sedentary">sedentary — Little or no exercise</option>
      <option value="moderate">moderate  — Moderate exercise or sports 3 - 5 days/week</option>
      <option value="active">active — Hard exercise or sports 6 - 7 days/week</option>
    </select>
     <input type="submit" name="submit" value="Submit">
<?php endif ?>
<?php

if(empty($_POST['weight']) || empty($_POST['activity'])) {
  echo "";
}
else {
  echo " <br> <br> <strong> Your information was saved succesfully! <br> <br> </strong>";
} 
?>


<a class="btn btn-primary" href="calc.php"> Go back</a>
</form>
</div>
</div>


<?php

error_reporting(0);
ini_set('display_errors', 0);

session_start();
$currentuser = $_SESSION['username'];

$db = mysqli_connect('mysql.metropolia.fi', 'mikkooke', 'Juhani99', 'mikkooke');

$query = "SELECT userid FROM users WHERE username = '$currentuser'";
$result = $db->query($query);
$id = mysqli_fetch_array($result);

$nweight = mysqli_real_escape_string($db, $_POST['weight']);

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


$query = "SELECT * FROM users WHERE userid = $id[0] ORDER BY date DESC";
$result = $db->query($query);
$u = mysqli_fetch_array($result);

$date = $u[4];

    $today = date('y-m-d');
    function age($date,$today) {
    if (strtotime($date)<strtotime('-124 year')) {
            echo"Year is invalid ";
            }else { 
            $now = date('y-m-d');
            $strtodate = strtotime($date);
            $now = strtotime($now);

            if($strtodate == $now) {
                echo "wrong date ";        
        }
      }

   $birthdate = new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $date))))));
   $today= new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $today))))));           
    $age = $birthdate->diff($today)->y;
    return $age;
}
$date2 = age($date,$today); 
$height = $u[5];
$gender = $u[6];


$query = "SELECT * FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$k = mysqli_fetch_array($result);



$nowDate = date("Y/m/d");


if ($gender == "female") {
  $value = 10 * $nweight  + 6.25 * $height - 5 * $date2 - 161;
  $value = $value * $activity;
} 
if ($gender == "male") {
  $value = 10 * $nweight + 6.25 * $height - 5 * $date2 + 5;
  $value = $value * $activity;
}

$stmt = $db->prepare("INSERT INTO calorycalc2 (userid, date, weight, activity, energy, goal, month) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiiisi", $a, $b, $c, $d, $e, $f, $g);

$a = $k[1];
$b = $nowDate;
$c = $nweight;
$d = $activity;
$e = $value;
$f = $k[6];
$g = $k[7];
$stmt->execute();


?>
</div>
</body>
</html>  