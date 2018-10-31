<?php
error_reporting(E_ALL);
ob_start();
include('login.php');
include('signup.php');
ob_end_clean();
$db=mysqli_connect("localhost","avantika","avantika","db1") or die("connection not established");
if(isset($_POST['book_ticket'])){
  $from=$_POST['from'];
  $to=$_POST['to'];
  $u_id=$_SESSION['u_id'];
  $t_id=rand(0,300);
  //echo "original t_id:".$t_id."<br>";
  //store the t_id in database

  if($sql=mysqli_query($db,"SELECT t_id from passenger")){
    while($row=mysqli_fetch_assoc($sql)){
      //echo 'row[t_id]:'.$row['t_id']; //content of the row
      //echo 't_id:'.$t_id."<br>";
      if($t_id==(int)$row['t_id']){
        //echo "not yet generated";
        $t_id=rand(0,300);
        //echo 'generated t_id:'.$t_id."<br>";
      }
    }
  }else{
    printf("ERROR: Could not able to execute $sql. " . mysqli_error($db));
  }

  //echo "ticket:".$t_id;
  //defining status by chechking the availability of seats of that type
  $status="waiting";
  $t_no = $_POST['train_no']; //from search_for_train.php
  //echo "train:".$t_no;
  if($type=='AC_fare'){
    //check number of B_seat
    $sql=mysqli_query($db,"select A_seat from train_status where t_no='$t_no'");
    $row=mysqli_fetch_assoc($sql);
    $result=(int)$row['A_seat'];
    if($result>0){
      $status="booked";
      //decrease the number of seats in B_seat
      mysqli_query($db,"UPDATE train_status SET A_seat=A_seat-1 where t_no='$t_no'");
    }
  }else{
    $sql=mysqli_query($db,"select B_seat from train_status where t_no='$t_no'");
    $row=mysqli_fetch_assoc($sql);
    $result=$row['B_seat'];
    if($result>0){
      $status="booked";
      //decrease the number of seats in A_seat
      mysqli_query($db,"UPDATE train_status SET B_seat=B_seat-1 where t_no='$t_no'");
    }
  }
  $final="INSERT INTO passenger(u_id,t_id,status,source,destination,t_no) VALUES($u_id,$t_id,'$status','$from','$to',$t_no)";
  if(mysqli_query($db,$final)){
    echo '<script type="text/javascript">alert("'.$status.'");</script>';
  }else{
    printf("ERROR: Could not able to execute $sql. " . mysqli_error($db));
  }
}
  ?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>booking</title>
    </head>
    <body>
      plan your journey <br>
      <form class="" action="book.php" method="post" id="book">
        <table>
          <tr>
            <td>from:</td>
            <td><select class="" name="from" id="from" required>
              <option value="Kanpur(KNP)">Kanpur(KNP)</option>
              <option value="Patna(PTA)">Patna(PTA)</option>
              <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
              <option value="Bhopal(BHO)">Bhopal(BHO)</option>
            </select></td>
          </tr>
          <tr>
            <td>to:</td>
            <td><select class="" name="to" id="to" required>
              <option value="Kanpur(KNP)">Kanpur(KNP)</option>
              <option value="Patna(PTA)">Patna(PTA)</option>
              <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
              <option value="Bhopal(BHO)">Bhopal(BHO)</option>
            </select></td>
          </tr>
          <tr>
            <td>category:</td>
            <td><select class="" name="type" id="type" required>
              <option value="AC_fare">AC_fare</option>
              <option value="g_fare">g_fare</option>
            </select></td>
          </tr>
        </table>
        <select class="" name="train_no">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button type="submit" name="book_ticket">book</button>
      </form><br>
      <a href="search_for_train.php">go back</a>
      <a href="#">clear fields</a><br>
      <a href="user_homepage.php">homepage</a><br>
      <a href="logout.php">logout</a><br>
      <?php
        $u_id=$_SESSION['u_id'];
        $db=mysqli_connect("localhost","avantika","avantika","db1") or die("connection not established");
        $sql=mysqli_query($db,"SELECT * from passenger where u_id=$u_id");
        $row=mysqli_fetch_assoc($sql);
        if($row['status']=='booked'){
          echo "Your seat has been booked.Your PNR number is:".$row['p_id'];
        }
       ?>
    </body>
  </html>
