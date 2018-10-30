<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    Welcome,<?php printf("%s",$_SESSION['first_name']); ?><br>
    <a href="search_for_train.php">search for train</a><br>
    <a href="enquiry_for_PNR.php">enquiry for PNR</a><br>
    <a href="cancel_tickets.php">cancel tickets</a><br>
    <a href="#">logout</a><br>
  </body>
</html>
