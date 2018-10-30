<?php
  error_reporting(E_ALL);
  $db=mysqli_connect("localhost","avantika","avantika","db1"); #port number

  if(isset($_POST['search'])){
    $from=$_POST['from'];
    $to=$_POST['to'];
    $type=$_POST['type'];

    $sql1="SELECT T.t_no,T.start_t,S.arrival_time as arrival_time from train T,station S
          WHERE T.start_station='$from' and (T.end_station='$to' or S.s_name='$to') and T.t_no=S.t_no";
    $result1=mysqli_query($db,$sql1); //=$db->query($sql); gives an object

    if(!$result1 || mysqli_num_rows($result1)==0){
      //output data of each row
        echo "0 results";
      }else{
        while($row=mysqli_fetch_assoc($result1)){
          $train=$row['t_no'];
          $sql2=""; $fare="";
          if($type=='AC_fare'){
            $sql2=mysqli_query($db,"SELECT AC_fare from train_status where t_no='$train'");
            $row1=mysqli_fetch_assoc($sql2);
            $fare=$row1['AC_fare'];
          }else {
            $sql2=mysqli_query($db,"SELECT g_fare from train_status where t_no='$train'");
            $row1=mysqli_fetch_assoc($sql2);
            $fare=$row1['g_fare'];
          }

          echo "<br>train_no:".$row['t_no']." start time:".$row['start_t']." end time:".$row['arrival_time']." ";
          echo "fare:".$fare."<br>";
      }
    }
//learn nested queries first QUERY 2 NOT CONSIDERING CURRENTLY
/*    $sql2="SELECT S.t_no,T.arrival_time from station S
          where t_no=(select T.t_no from station T where T.s_name='$from') and S.s_name='$to'";
    $result2=mysqli_query($db,$sql2);
    if(!$result2 || mysqli_num_rows($result2)==0){
      //output data of each row
        echo "0 results";
      }else{
        while($row=mysqli_fetch_assoc($result2)){
          echo "<br>train_no:".$row['t_no']."<br>start time:".$row['arrival_time']."<br>";
      }
    } */
    }

    if(isset($_POST['indirect_search'])){
      $from=$_POST['from'];
      $to=$_POST['to'];
      $type=$_POST['type'];

      $sql1="SELECT S.t_no,T.arrival_time from station S
            where t_no=(select T.t_no from station T where T.s_name='$from') and S.s_name='$to'";
      $result1=mysqli_query($db,$sql1); //=$db->query($sql); gives an object

      if(!$result1 || mysqli_num_rows($result1)==0){
        //output data of each row
          echo "0 results";
        }else{
          while($row=mysqli_fetch_assoc($result1)){
            $train=$row['t_no'];
            echo "".$train."";
            $sql2=""; $fare="";
            if($type=='AC_fare'){
              $sql2=mysqli_query($db,"SELECT AC_fare from train_status where t_no='$train'");
              $row1=mysqli_fetch_assoc($sql2);
              $fare=$row1['AC_fare'];
            }else {
              $sql2=mysqli_query($db,"SELECT g_fare from train_status where t_no='$train'");
              $row1=mysqli_fetch_assoc($sql2);
              $fare=$row1['g_fare'];
            }

            echo "<br>train_no:".$row['t_no']." start time:".$row['start_t']." end time:".$row['arrival_time']." ";
            echo "fare:".$fare."<br>";
        }
      }
    }


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>seach for train</title>
  </head>
  <body>
    plan your journey <br>
    <form class="" action="search_for_train.php" method="post">
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
      <button type="submit" name="search">direct search</button>
      <button type="submit" name="indirect_search">indirect search</button>
    </form>

    <!--<label for="to">to</label>
    <input type="text" name="to" value=""><br>
    <label for="date_of_travel">date of travel</label>
    <input type="text" name="date_of_travel" value=""><br> -->

    <a href="#">clear fields</a><br>
    <a href="user_homepage.php">go back</a><br>
    <a href="#">logout</a><br>
  </body>
</html>
