<?php
  include 'databaseInfo.php'; //database information to access MySQL
  $id = $_POST['id'];
  $email = $_POST['email'];
  //$id=48;
  //$email = "tj@virginia.edu";
  $timestamp = "April 2016";

  //echo "HEYYYYYYYY";
  $itemQuery = $db->prepare("INSERT INTO `Buy`(`email`, `item_id`, `timestamp`) VALUES (?,?,?)") or die("Your insertion couldn't be done: " . $db->error);
  $itemQuery->bind_param("sds",$email, $id, $timestamp);
  $itemQuery->execute();
?>
