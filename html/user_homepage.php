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
        <p>Welcome, <strong><?php echo $_SESSION['first_name'] ;?></strong></p>
        <!-- search for train code -->
        Search
        <form class="" action="search_for_train.php" method="post" id="search_for_train">
          <table>
            <tr>
              <td>from:</td>
              <td><select class="selectpicker" name="from" id="from" required>
                <option value="Kanpur(KNP)">Kanpur(KNP)</option>
                <option value="Patna(PTA)">Patna(PTA)</option>
                <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
                <option value="Bhopal(BHO)">Bhopal(BHO)</option>
              </select></td>
            </tr>
            <tr>
              <td>to:</td>
              <td><select class="selectpicker" name="to" id="to" required>
                <option value="Kanpur(KNP)">Kanpur(KNP)</option>
                <option value="Patna(PTA)">Patna(PTA)</option>
                <option value="Bengaluru(BNG)">Bengaluru(BNG)</option>
                <option value="Bhopal(BHO)">Bhopal(BHO)</option>
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
          <button type="submit" name="search">direct search</button>
          <button type="submit" name="indirect_search">search</button>
        </form>

        <!-- enquiry -->
        <br>
        Make enquiry
        <form class="" action="enquiry_for_PNR.php" method="post">
          <label for="PNR">PNR</label>
          <input type="text" name="PNR" value=""><br>
          <button type="submit" name="check">check</button>
        </form> <br>
        <a href="cancel_tickets.php">cancel tickets</a><br>
        <a href="logout.php">logout</a><br>
        Already know which train you want to travel from?<a href="book.php">book tickets here</a>
      <?php endif ?>
  </body>
</html>
