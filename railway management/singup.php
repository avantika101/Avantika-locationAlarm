<?php
  error_reporting(E_ERROR | E_PARSE);
  $db=mysqli_connect("localhost","avantika","avantika","db1"); #port number
  if(!$db){
    printf("not connected to server");
  }
  if(isset($_POST['register'])){
    $first_name=mysqli_real_escape_string($db,$_POST['first_name']);
    $last_name=mysqli_real_escape_string($db,$_POST['last_name']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $age=mysqli_real_escape_string($db,$_POST['age']);
    $gender=mysqli_real_escape_string($db,$_POST['gender']);
    $password=mysqli_real_escape_string($db,$_POST['password']);
    $retype_password=mysqli_real_escape_string($db,$_POST['retype_password']);

    //save to database
    if($password == $retype_password){
      #$password=md5($password);//encrypting the password
      $sql="INSERT INTO user (first_name,last_name,email,gender,age,password) VALUES('$first_name','$last_name','$email','$gender','$age','$password')";
    //session_start();
      if(mysqli_query($db, $sql)){
        //echo "Records added successfully.";
        $_SESSION['first_name']=$row['first_name'];
        $_SESSION['u_id']=$row['u_id'];
        echo "signup successful! welcome,".$_SESSION['first_name'];
        echo "<script> window.location.assign('user_homepage.php'); </script>";
    } else{
        printf("ERROR: Could not able to execute $sql. " . mysqli_error($db));
    };
      //$_SESSION['message']="you are now logged in";
      //$_SESSION['first_name']=$first_name;
      //header("location:user_homepage.php"); //redirecting to user home page
    }
    else{
      $_SESSION['message']="the passwords do not match";
    }
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body style="">
    Register Here!

    <form class="" action="signup.php" method="POST">
      <?php session_start(); ?>
      <table>
        <tr>
          <td>first name:</td>
          <td><input type="text" name="first_name" value="" required/></td>
        </tr>
        <tr>
          <td>last name:</td>
          <td><input type="text" name="last_name" value="" required></td>
        </tr>
        <tr>
          <td>email:</td>
          <td><input type="text" name="email" value="" required/></td>
        </tr>
        <tr>
          <td>age:</td>
          <td><input type="text" name="age" value="" required/></td>
        </tr>
        <tr>
          <td>gender:</td>
          <td><input type="text" name="gender" value="" placeholder="male/female/older" required/></td>
        </tr>
        <tr>
          <td>Password:</td>
          <td><input type="password" name="password" value="" required/></td>
        </tr>
        <tr>
          <td>Retype Password:</td>
          <td><input type="password" name="retype_password" value="" required/></td>
        </tr>
      </table>
      <button type="submit" name="register" id="register">Register</button>
    </form>
    <a href="#">clear all fields</a><br>
    <a href="homepage.php">go back</a>
</body>
</html>
