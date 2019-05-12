<!DOCTYPE html>
<html lang="en">
<title>Progress</title>
<?php

error_reporting(0);
ini_set('display_errors', 0);

session_start();
$currentuser = $_SESSION['username'];


$db = mysqli_connect('mysql.metropolia.fi', 'mikkooke', 'Juhani99', 'mikkooke');

$query = "SELECT userid FROM users WHERE username = '$currentuser'";
$result = $db->query($query);
$id = mysqli_fetch_array($result);



$query = "SELECT month FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id ASC";
$result = $db->query($query);
$month = mysqli_fetch_array($result);


$query = "SELECT weight FROM calorycalc2 WHERE userid = $id[0]";
$result = $db->query($query);
$weight = mysqli_fetch_array($result);


$query = "SELECT goal FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id ASC";
$result = $db->query($query);
$goal = mysqli_fetch_array($result);


$query = "SELECT weight FROM calorycalc2 WHERE userid = $id[0]";
$result = mysqli_query($db, $query) or die(mysqli_error());

$array = array();

while($row = mysqli_fetch_assoc($result)) {
   $array[] = $row;
}




$goalw = $weight[0] -  $month[0];
$rate = $month[0] / 4;

if ($goal[0]=='lose') {
  $rate1 = $weight[0] - $rate;
  $rate2 = $rate1 - $rate;
  $rate3 = $rate2 - $rate;
  $rate4 = $rate3 - $rate;
}
  elseif ($goal[0]=='maintain') {
    $rate1 = $weight[0];
    $rate2 = $weight[0];
    $rate3 = $weight[0];
    $rate4 = $weight[0];
}

  else {
    $rate1 = $weight[0] + $rate;
    $rate2 = $rate1 + $rate;
    $rate3 = $rate2 + $rate;
    $rate4 = $rate3 + $rate;
}

$query = "SELECT month FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$month2 = mysqli_fetch_array($result);


$query = "SELECT weight FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$weight2 = mysqli_fetch_array($result);

$query = "SELECT goal FROM calorycalc2 WHERE userid = $id[0] ORDER BY cal_id DESC";
$result = $db->query($query);
$goal2 = mysqli_fetch_array($result);


$goalw2 = $weight2[0] -  $month2[0];
$newrate = $month2[0] / 4;

?>


<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Progress - FatLess</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/progress.css">
</head>

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
.jotain {
  margin-right: 28%;
}  
@media screen and (max-width: 800px) {
  .btn {
    width: 100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
</style>

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



<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Progress', 'your goal'],
          ['week 0',  <?php echo $weight[0]?>,     <?php echo $weight[0]?>],

          ['week 1',  <?php echo next($array)['weight']?>,       <?php echo $rate1?>],
          ['week 2',  <?php echo next($array)['weight']?>,       <?php echo $rate2?>],
          ['week 3',  <?php echo next($array)['weight']?>,       <?php echo $rate3?>],
          ['week 4',  <?php echo next($array)['weight']?>,       <?php echo $rate4?>],
        ]);

        var options = {
          title: 'Your weight progress',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

          chart.draw(data, options);
      } 
    </script>

<?php
if ($goal2[0]=='lose') {
  $newrate1 = current($array)['weight'] - $newrate;
  $newrate2 = $newrate1 - $newrate;
  $newrate3 = $newrate2 - $newrate;
  $newrate4 = $newrate3 - $newrate;
}
  elseif ($goal2[0]=='maintain') {
    $newrate1 = current($array)['weight'];
    $newrate2 = current($array)['weight'];
    $newrate3 = current($array)['weight'];
    $newrate4 = current($array)['weight'];
}

  else {
    $newrate1 = current($array)['weight']; + $newrate;
    $newrate2 = $newrate1 + $newrate;
    $newrate3 = $newrate2 + $newrate;
    $newrate4 = $newrate3 + $newrate;
}
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart2);
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Progress', 'your goal'],
          ['week 0',  <?php echo next($array)['weight']?>,     <?php echo current($array)['weight']?>],

          ['week 1',  <?php echo next($array)['weight']?>,       <?php echo $newrate1?>],
          ['week 2',  <?php echo next($array)['weight']?>,       <?php echo $newrate2?>],
          ['week 3',  <?php echo next($array)['weight']?>,       <?php echo $newrate3?>],
          ['week 4',  <?php echo next($array)['weight']?>,       <?php echo $newrate4?>],
        ]);

        var options = {
          title: 'Your weight progress',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

          chart.draw(data, options);
      } 
    
    </script>

<div class="container2">
     <h1>
  Progress
  </h1>
<p>
  Here you can see your progress compared to your goals
</p>
</div>

  <?php
if ($array[5]['weight']==0) :
?>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  <?php endif ?>

<?php
if ($array[5]['weight']!=0) :
?>
<div id="curve_chart2" style="width: 900px; height: 500px"></div>
<?php endif ?>

<?php
if ($array[4]['weight']!=0) :
?>
<div class="container2">
<p> You have reached the end of the month, update your goals by clicking the button</p>
<a class="btn btn-primary" href="goal.php">Update goals</a>
</div>
<?php endif ?>

</body>
</html>