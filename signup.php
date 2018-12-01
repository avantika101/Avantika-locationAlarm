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
  <script type="text/javascript">
	function validate()	{
		var EmailId=document.getElementById("email");
		var atpos = EmailId.value.indexOf("@");
    	var dotpos = EmailId.value.lastIndexOf(".");
		var pw=document.getElementById("pw");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=EmailId.value.length) 
		{
        	alert("Enter valid email-ID");
			EmailId.focus();
        	return false;
   		}
   		if(pw.value.length< 8)
		{
			alert("Password consists of atleast 8 characters");
			pw.focus();
			return false;
		}
		return true;
	}
</script>
<style type="text/css">
	#loginarea{
		background-color: white;
		width: 30%;
		margin: auto;
		border-radius: 25px;
		border: 2px solid blue;
		margin-top: 100px;
		background-color: rgba(0,0,0,0.2);
	    box-shadow: inset -2px -2px rgba(0,0,0,0.5);
	    padding: 40px;
	    font-family:sans-serif;
		font-size: 20px;
		color: white;
	}
	html { 
		background: url(img/bg4.jpg) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	#submit	{
		border-radius: 5px;
		background-color: rgba(0,0,0,0);
		padding: 7px 7px 7px 7px;
		box-shadow: inset -1px -1px rgba(0,0,0,0.5);
		font-family:"Comic Sans MS", cursive, sans-serif;
		font-size: 17px;
		margin:auto;
		margin-top: 20px;
  		display:block;
  		color: white;
	}
	#logintext	{
		text-align: center;
	}
	.data	{
		color: white;
	}
</style>
  <body style=""><div id="loginarea">
    <center>Register Here!</center>

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
          <td><input type="text" name="gender" value="" placeholder="male/female/other" required/></td>
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
	      <center>
      <button type="submit" name="register" id="register">Register!</button><center>
    </form>
    <center>
    <a href="homepage.php">go back</a></center></div>
</body>
</html>
