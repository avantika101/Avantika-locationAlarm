<?php
ob_start();
include('login.php');
include('signup.php');
ob_end_clean();

$db=mysqli_connect("localhost","avantika","avantika","db1") or doe("cannot connect to the server");
$PNR=$_POST['PNR'];
if(isset($_POST['cancel_tickets'])){
  mysqli_query($db,"CALL updateValue('$PNR')");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>cancel tickets</title>
  </head>
  <body>

    <form class="" action="cancel_tickets.php" method="post">
      <label for="PNR">PNR</label>
      <input type="text" name="PNR" value=""><br>
      <button type="submit" name="cancel_tickets">SUBMIT</button>
    </form>

    <a href="user_homepage.php">go back</a><br>
    <a href="logout.php">logout</a><br>
  </body>
</html>
