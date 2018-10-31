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
        <a href="search_for_train.php">search for train</a><br>
        <a href="enquiry_for_PNR.php">enquiry for PNR</a><br>
        <a href="cancel_tickets.php">cancel tickets</a><br>
        <a href="#">logout</a><br>
      <?php endif ?>
  </body>
</html>
