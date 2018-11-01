<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>enquiry for PNR</title>
  </head>
  <body>
    Status<br>
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
    <a href="user_homepage.php">go back</a><br>
    <a href="logout.php">logout</a><br>
  </body>
</html>
