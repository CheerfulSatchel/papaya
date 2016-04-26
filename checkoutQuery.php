<?php
	include 'databaseInfo.php'; //database information to access MySQL
  //$email = $_POST['userName'];
  $email = "tj@virginia.edu";

	$itemQuery = $db->prepare("SELECT * FROM Buy WHERE email = ?") or die("Your item deletion couldn't be done: " . $db->error);
  $itemQuery->bind_param("s", $email);
  $itemQuery->execute();
  $result = $itemQuery->get_result();

  if($result->num_rows > 0) {
    //declare items array
    $items = array();
    echo "Hello world";
    //echo "$result->num_rows"; prints 1 as expected
    $rows = $result->num_rows;
    for($i = 0; $i < $rows; $i++) {
      $row = $result->fetch_array();
      foreach ($row as $key=>$val):
        if($key === "item_id") {
          $items[] = $val;
          echo "$val";
        }
          endforeach;
      }
    }

    //$items now has all the item_ids we need to delete
    foreach($items as $value) {
      echo "$value";
      $itemQuery = $db->prepare("UPDATE item SET quantity = quantity - 1 WHERE item_id = ?") or die("Your item deletion couldn't be done: " . $db->error);
      $itemQuery->bind_param("s", $value);
      $itemQuery->execute();
    }

?>
