<?php
ob_start();
include('user_homepage.php');
include('enquiry_for_PNR.php');
include('search_for_train.php');
include('book.php');
ob_end_clean();
session_start();
session_destroy();
unset($_SESSION['u_id']);
$_SESSION['message']='You have been logged out';
header('location:homepage.php');
 ?>
