<?php
  session_start();
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
      $_SESSION['first_name']=$row['first_name'];
      $_SESSION['u_id']=$row['u_id'];
      $_SESSION['success']="you've been logged in!";
      header('location:user_homepage.php'); //redirecting to user home page NOT WORKING
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
  </head>
  <body>
  
  <div id="loginarea">
	<form class="" action="login.php" method="post">
     <div id="logintext">Login to Indian Railways!</div><br/><br/>
      <table>
           <tr><td><div class="data">Enter E-Mail ID:</div></td><td><input type="text" name="email"/></td></tr>
		<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
		<tr><td><div class="data">Enter Password:</div></td><td><input type="password" name="password"/></td></tr>
		<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
       </table>
      <button type="submit" name="login">Login</button>
    </form>
     	    <a href="homepage.php">Go back</a>

	
	</form></div>
  
  
  </body>
</html>
