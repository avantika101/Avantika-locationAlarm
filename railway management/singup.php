<?php
  session_start();
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
      if(mysqli_query($db, $sql)){
        $row=mysqli_query($db,"SELECT * from user where first_name='$first_name' and last_name='$last_name'
              and gender='$gender' and age='$age' and email='$email'");
        if($row1=mysqli_fetch_assoc($row)){
          $_SESSION['first_name']=$first_name;
          $_SESSION['u_id']=$row1['u_id'];
          $_SESSION['success']="your account has been created!";
          header('location:user_homepage.php');
        }
         //redirecting to user home page
        //echo "<script> window.location.assign('user_homepage.php'); </script>";
    } else{
        printf("ERROR: Could not able to execute $sql. " . mysqli_error($db));
    }
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
