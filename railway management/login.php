<?php
  //session_start();
  error_reporting(E_ERROR | E_PARSE);
  $db=mysqli_connect("localhost","avantika","avantika","db1");
  $email=mysqli_real_escape_string($db,$_POST['email']);
  $password=mysqli_real_escape_string($db,$_POST['password']);

  //query the db for user email and passwords
  if(isset($_POST['login'])){
    $result=mysqli_query($db,"select * from user where email='$email' and password='$password'")
            or die("failed to query database");
    $row=mysqli_fetch_array($result);
    if(($row['email']==$email)&& ($row['password']==$password)){
      //echo "login successful! welcome,",$row['first_name'];
      //header("Location:user_homepage.php"); //redirecting to user home page NOT WORKING
      $_SESSION['first_name']=$row['first_name'];
      $_SESSION['u_id']=$row['u_id'];
      echo "login successful! welcome,".$_SESSION['first_name'];
      //echo "<script> window.location.assign('user_homepage.php'); </script>"; //REDIRECTION WORKING
      exit();
    }else{
    echo "failed to login";
    }

  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <form class="" action="login.php" method="post">
      <?php session_start(); ?>
      <table>
        <tr>
          <td>email:</td>
          <td><input type="text" name="email" value="" required/></td>
        </tr>
        <tr>
        <td>password:</td>
        <td><input type="password" name="password" value="" required/></td>
        </tr>
      </table>
      <button type="submit" name="login">Login</button>
    </form>
    <a href="homepage.php">go back</a>
  </body>
</html>
