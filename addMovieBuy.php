<?php
  include 'databaseInfo.php'; //database information to access MySQL
  //$id = $_POST['id'];
  //$email = $_POST['email'];
  $id=113;
  $email = "mjm5qu@virginia.edu";
  $timestamp = "April 2016";

  //echo "HEYYYYYYYY";
  $itemQuery = $db->prepare("INSERT INTO `Buy`(`email`, `item_id`, `timestamp`) VALUES (?,?,?)") or die("Your insertion couldn't be done: " . $db->error);
  $itemQuery->bind_param("sds",$email, $id, $timestamp);
  $itemQuery->execute();

  $itemQuery = $db->prepare("UPDATE Buy SET Count = Count + 1 WHERE email = ? AND item_id = ?") or die("Your insertion couldn't be done: " . $db->error);
  $itemQuery->bind_param("ss",$email, $id);
  $itemQuery->execute();
?>
