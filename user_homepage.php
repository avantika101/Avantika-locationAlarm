<?php
  ob_start();
  include('login.php');
  include('signup.php');
  ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>user homepage</title>
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
      <?php if(isset($_SESSION['success'])): ?>
        <div class="error success">
          <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
             ?>
          </h3>
        </div>
      <?php endif ?>

      <?php if(isset($_SESSION['first_name'])): ?>
	  <div id="loginarea">
        <div id="logintext">Welcome, <strong><?php echo $_SESSION['first_name'] ;?></strong></div>
        <!-- search for train code -->
		<center>Search</center>
		
        <form class="" action="search_for_train.php" method="post" id="search_for_train">
          <table>
		<tr>
            <tr>
              <td>from:</td>
              <td><select class="selectpicker" name="from" id="from" required>
                <option value="Kanpur(KNP)">Kanpur(KNP)</option>
                <option value="Patna(PTA)">Patna(PTA)</option>
                <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
                <option value="Bhopal(BHO)">Bhopal(BHO)</option>
			    <option value="Gorakhpur">Gorakhpur</option>
                <option value="Indore">Indore</option>
              </select></td>
            </tr>
            <tr>
              <td>to:</td>
              <td><select class="selectpicker" name="to" id="to" required>
                <option value="Kanpur(KNP)">Kanpur(KNP)</option>
                <option value="Patna(PTA)">Patna(PTA)</option>
                <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
                <option value="Bhopal(BHO)">Bhopal(BHO)</option>
			    <option value="Gorakhpur">Gorakhpur</option>
                <option value="Indore">Indore</option>

              </select></td>
            </tr>
            <tr>
              <td>category:</td>
              <td><select class="selectpicker" name="type" id="type" required>
                <option value="AC_fare">AC_fare</option>
                <option value="g_fare">g_fare</option>
              </select></td>
            </tr>
          </table>
          <button type="submit" name="search">search!</button>
         
        </form>
		
        <!-- enquiry -->
        <br><center>
        Make enquiry
        <form class="" action="enquiry_for_PNR.php" method="post">
          <label for="PNR">PNR</label>
          <input type="text" name="PNR" value=""><br>
          <button type="submit" name="check">check</button>
        </form> <br>
        <a href="cancel_tickets.php">cancel tickets</a><br>
        <a href="logout.php">logout</a><br>
        Already know which train you want to travel from?<br><a href="book.php">book tickets here</a>
      <?php endif ?></center>
  </body>
</html>
