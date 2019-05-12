<?php
$age = 22;
$weight = 80;
$height = 180;
$gender = male;
$activity = $moderate;

$male =161;
$female =5;
$sedentary = 1.2;
$moderate = 1.3;
$active = 1.4;
echo $female;
$value = "";
print ($value);
if ($gender == female) {
  $value = 10 * $Weight  + 6.25 * $height - 5 * $age - 161;
  $value = $value * $activity;
} else {
  $value = 10 * $weight + 6.25 * $height - 5 * $age + 5;
  $value = $value * $activity; 
}
echo "<h2>" . $value . "</h2>";
?>

<?php
$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
$x = 5;
$y = 4;

echo "<h2>" . $txt1 . "</h2>";
echo "Study PHP at " . $txt2 . "<br>";
echo $x + $y;
?>