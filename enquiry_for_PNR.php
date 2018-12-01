<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>enquiry for PNR</title>
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
  <body><center>
  <div id="loginarea">
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
              echo "<table><tr><td>PID</td><td>:</td><td>".$row['p_id']."</td></tr><tr><td>USER ID</td><td>:</td><td>".$row['u_id']."</td></tr><tr><td>TICKET ID</td><td>:</td><td>".$row['t_id']."</td></tr><tr><td>SOURCE</td><td>:</td><td>".$row['source']."</td></tr><tr><td>DESTINATION</td><td>:</td><td>".$row['destination']."</td></tr><tr><td>TRAIN NO</td><td>:</td><td>".$row['t_no']."</td></tr><tr><td>STATUS</td><td>:</td><td>".$row['status']."</td></tr></table>";
			
			
			}
          }else {
            printf("PNR NOT FOUND");
          }
        }
       ?>
    <a href="user_homepage.php">go back</a><br>
    <a href="logout.php">logout</a><br>
	</div></center>
  </body>
</html>
