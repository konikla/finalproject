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
  <h1>Profile</h1>

  <?php
if (isset($_POST['submit']) == 0) :
?>

 <p> Hello!
  Here you can change your profile information.<br> <strong> Be aware </strong> that you have to start all over if you modify these information</p>

<?php 
endif ?>

<?php

$expression = $_POST['submit'] and $_POST['weight'] and $_POST['height'] and $_POST['age'] and $_POST['gender'] and $_POST['activity'] and $_POST['goal'] and $_POST['month'];

if (!isset($expression)) :  


?>
<div>
  <form action= "#<?php $_PHP_SELF ?>" method = "POST">
    <label>weight</label>
    <input required type="number" name="weight" placeholder="kg">

    <label>height</label>
    <input required="" type="number" name="height" placeholder="cm">

    <label>age</label>
    <input required type="date" name="age">
<br> <br>
    <label>gender</label>
    <select name="gender">
      <option value="male">male</option>
      <option value="female">female</option>
    </select>

    <label>activity</label>
    <select id="activity" name="activity">
      <option value="sedentary">sedentary — Little or no exercise</option>
      <option value="moderate">moderate  — Moderate exercise or sports 3 - 5 days/week</option>
      <option value="active">active — Hard exercise or sports 6 - 7 days/week</option>
    </select>

    <label>Goal</label>
    <select id="goal" name="goal">
      <option value="lose">lose weight</option>
      <option value="maintain">maintain weight</option>
      <option value="gain">gain weight</option>
    </select>

    <label>How much weight you want to lose/gain per month</label>
      <input required="" type="number" name="month" placeholder="kg">

      <input type="submit" name="submit" value="Submit">
  </form>
</div>
</div>
<?php 
endif ?>

<?php

    print("<br>");
    print("<br>");

    $date = $_REQUEST['age'];
    $today = date('y-m-d');
    function age($date,$today) {
    if (strtotime($date)<strtotime('-124 year')) {
            echo"";
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
$nowDate = date("Y/m/d");

$age = mysqli_real_escape_string($db, $_POST['age']);
$weight = mysqli_real_escape_string($db, $_POST['weight']);
$height = mysqli_real_escape_string($db, $_POST['height']);
$month = mysqli_real_escape_string($db, $_POST['month']);

if(isset($_POST['goal'])){
$goal = mysqli_real_escape_string($db, $_POST['goal']);
}

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

if(empty($_POST['weight']) || empty($_POST['height']) || empty($_POST['age']) || empty($_POST['gender']) || empty($_POST['activity']) || empty($_POST['goal']) || empty($_POST['month'])) {

  echo "";
  
}

else {
  $query = "DELETE FROM calorycalc2 WHERE userid = $id[0]";
  mysqli_query($db, $query);
  echo "Your information was saved succesfully!";;
}

/*
 $id[0], '$nowDate', $weight, $activity, $value, '$goal', $month
*/

$stmt = $db->prepare("INSERT INTO calorycalc2 (userid, date ,weight, activity, energy, goal, month) VALUES(?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiiisi", $a, $b, $c, $d, $e, $f, $g);

$a = $id[0];
$b = $nowDate;
$c = $weight;
$d = $activity;
$e = $value;
$f = $goal;
$g = $month;
$stmt->execute();

$query = "UPDATE users SET date='$date', height=$height, gender='$gender' WHERE username = '$currentuser'";
mysqli_query($db, $query);


if (isset($_POST['submit'])!=0) :
?>

<br>
<a class="btn btn-primary" href="profile2.php"> Go back</a>
<?php endif ?>






</body>
</html>