<?php

$displayform = True;
if (isset($_POST['submit'])) {
  $displayform = False;
  print("<br>");
  print("<br>");
  echo "<h5> Your information has been saved succesfully </h5>";
}
if ($displayform) {
?>







<?php
}
?>