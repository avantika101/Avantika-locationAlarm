<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>seach for train</title>
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
  <body>
  <div id="loginarea">
    <center>plan your journey<center><br>
    <!-- changed -->
    <?php
    error_reporting(E_ALL);
    ob_start();
    include('user_homepage.php');
    include('login.php');
    include('signup.php');
    ob_end_clean();

      error_reporting(E_ALL);
      $db=mysqli_connect("localhost","avantika","avantika","db1")or die("connection not established"); #port number

      if(isset($_POST['search'])){
        $from=$_POST['from'];
		$to=$_POST['to'];
        $type=$_POST['type'];
			//$sql="select * from user";  
			if($from==$to)
				echo "source and destination cannot be same!";
			else{
				if(($to=="Gorakhpur")||($to=="Indore")){
					$sql="select T.t_no,T.t_name,T.start_t,S.arrival_time from train T,station S where T.t_no=S.t_no and T.start_station='$from'";
				}
				else if(($from=="Gorakhpur")||($from=="Indore")){
					$sql="select T.t_no,T.t_name,S.arrival_time as start_t,T.arrival_time from train T,station S where T.t_no=S.t_no and T.start_station='$to'";
				}
				else{
					$sql="select * from train where start_station='$from' and end_station='$to'";
				}
												
        if($result1=mysqli_query($db,$sql)){
			//echo "working";
		}else{
			printf("ERROR: Could not execute $sql. " . mysqli_error($db));
		}
		
        if(!$result1 || mysqli_num_rows($result1)==0){
          //output data of each row
            echo "0 results";
          }else{
            while($row=mysqli_fetch_assoc($result1)){
              //$i=$i+1;
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
              echo "<br><table><tr><td>train_no</td><td>:</td><td>".$row['t_no']."</td></tr><tr><td>train name</td><td>:</td><td>".$row['t_name']."</td></tr><tr><td>start time</td><td>:</td><td>".$row['start_t']."</td></tr><tr><td>end time</td><td>:</td><td>".$row['arrival_time']."</td></tr>";
              echo "<tr><td>fare</td><td>:</td><td>".$fare."</td><tr></table><br>";
              //echo "<input type='button' onclick='book('"."$i".".');' value='book ticket'/>";
          }
			}}
        }
     ?>
    <!-- change end --><br>
    <a href="book.php">want to book?</a><br>
    <a href="user_homepage.php">go back</a><br>
    <a href="logout.php">logout</a><br>
	</div>

  </body>
</html>
