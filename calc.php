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

.container2 {
  margin: 50px;
}

h1,
h2,
h3,
h4,
h5,
h6 {
margin-top: 40px;
}  

.result {
background-color: #4caf50;
color: white;
border-radius: 5px;
margin-top: 50px;
width: 60%;
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 12px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 18px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

form {
  margin-top: 100px;
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


<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();
$currentuser = $_SESSION['username'];
$db = mysqli_connect('mysql.metropolia.fi', 'mikkooke', 'Juhani99', 'mikkooke');

$query = "SELECT userid FROM users WHERE username = '$currentuser'";
$result = $db->query($query);
$id = mysqli_fetch_array($result);
print("<br>");
print("<br>");


$query = "SELECT energy FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$energy = mysqli_fetch_array($result);

$query = "SELECT weight FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$weight = mysqli_fetch_array($result);

$query = "SELECT date FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$date = mysqli_fetch_array($result);

?>
<div class="container2">
<h1>Calorie counter</h1>
<div class=" alert alert-success result">  
<h4> Current calory need: 
<?php
echo $energy[0] . " ";
?>
kcal per day
</h4>
</div>
<a class="btn btn-primary" href="formit.php"> Update Weight</a>
<div class="alert alert-primary" role="alert">
  Update your weight once a week to see your progress.<br>
  Last update was <?php echo "<strong>" .  $weight[0] . "kg in " .  $date[0] . "</strong>"?>
  
</div>
</div>

</body>
</html>