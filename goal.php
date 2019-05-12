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

<h2>
  Update
</h2>
</div>
<?php
if (isset($_POST['submit']) != 0) :
?>

<p> Your information was saved succesfully </p>
<a class="btn btn-primary" href="progress.php">Go back</a>
</div>
<?php endif ?>

<?php
if (isset($_POST['submit']) == 0) :
?>

<div class="container2">
<p>
  You can change your goal or continue with the same goal
</p>

<div>
  <form action= "#<?php $_PHP_SELF ?>" method = "POST">

 <label>Goal</label>
    <select id="goal" name="goal">
      <option value="lose">lose weight</option>
      <option value="maintain">maintain weight</option>
      <option value="gain">gain weight</option>
    </select>
    <br> <br> <br>
    <label>How much weight you want to lose/gain per month</label>
      <input required type="number" name="month" placeholder="kg">

      <input type="submit" name="submit" value="Submit">
  </form>
</div>
<?php endif ?>
</div>

<?php
$query = "SELECT * FROM calorycalc2 WHERE userid = $id[0]";
$result1 = mysqli_query($db, $query) or die(mysqli_error());

$array = array();

while($row = mysqli_fetch_assoc($result1)) {
   $array[] = $row;
}

$month = mysqli_real_escape_string($db, $_POST['month']);

if(isset($_POST['goal'])){
$goal = mysqli_real_escape_string($db, $_POST['goal']);
}

$query = "UPDATE calorycalc2 SET goal='$goal', month=$month WHERE userid = $id[0] ORDER BY cal_id DESC LIMIT 1";
mysqli_query($db, $query);

?>


</body>
</html>


