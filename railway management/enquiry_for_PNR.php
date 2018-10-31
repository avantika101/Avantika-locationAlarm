<?php
$PNR=""; $USER=""; $TICKET=""; $SOURCE=""; $DESTINATION=""; $TRAIN="";
  error_reporting(E_ALL);
  $db=mysqli_connect("localhost","avantika","avantika","db1") or die("connection not established");
  if(isset($_POST['check'])){
    $PNR=$_POST['PNR'];
    if($sql=mysqli_query($db,"SELECT * from passenger where p_id='$PNR'")){
      while($row=mysqli_fetch_assoc($sql)){
        $PNR=$row['p_id'];
        $USER=$row['u_id'];
        $TICKET=$row['t_id'];
        $SOURCE=$row['source'];
        $DESTINATION=$row['destination'];
        $TRAIN=$row['t_no'];
        echo "<tr>".$row['p_id']."</tr><tr>".$row['u_id']."</tr><tr>".$row['t_id']."</tr><tr>".$row['source']."</tr><tr>".$row['destination']."</tr><tr>".$row['t_no']."</tr>";
      }
    }else {
      printf("PNR NOT FOUND");
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>enquiry for PNR</title>
  </head>
  <body>
    Status <br>
    <form class="" action="enquiry_for_PNR.php" method="post">
      <label for="PNR">PNR</label>
      <input type="text" name="PNR" value=""><br>
      <button type="submit" name="check">check</button>
    </form>
    <table>
      <tr>
        <th>PNR</th><th>USER ID</th><th>TICKET ID</th><th>SOURCE</th><th>DESTINATION</th><th>TRAIN</th>
      </tr>
      <tr>
        <td id="PNR"><?php $PNR ?></td>
        <td id="USER ID"><?php $USER ?></td>
        <td id="TICKET ID"><?php $TICKET ?></td>
        <td id="SOURCE"><?php $SOURCE ?></td>
        <td id="DESTINATION"><?php $DESTINATION ?></td>
        <td id="TRAIN"><?php $TRAIN ?></td>
      </tr>
    </table>

    <a href="user_homepage.php">go back</a><br>
    <a href="#">logout</a><br>
  </body>
</html>
