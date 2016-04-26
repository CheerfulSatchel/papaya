<?php ini_set('display_errors', 1); ?>

<!DOCTYPE html>
<!--
 	Page to sell an item, receives a name and category as post
  Users can only sell an item that the store carries
  The decision here is to identify items by name and category only
-->
<html>
	<title>
	   Sell an Item
	</title>
  <body>
    <?php
    session_start();
    //Get the item String and category from post
    if(isset($_POST['searchItem'])) {
      $itemString = $_POST['searchItem'];
      $itemString = trim($itemString);
      //$_SESSION['itemToSell'] = $itemString;
    }
    if(isset($_POST['category'])) {
      $category = $_POST['category'];
      $category = trim($category);
      //$_SESSION['category'] = $category;
    }
    if(isset($_POST['quantity'])) {
      $quantityToAdd = $_POST['quantity'];
      $quantityToAdd = trim($quantityToAdd);
    }
    //Database parameters
    $server = "stardock.cs.virginia.edu";
    $username = "cs4750mjm5qu";
    $dbpassword = "snowball";
    $db_name = "cs4750mjm5qu";
    $db = new mysqli("$server", "$username", "$dbpassword", "$db_name");
    //Try to connect
    if ($db->connect_error){
      die("Connection error: " . $db->connect_error);
    }
    if($category == "music") {
      $query = "Select * from Item Natural Join CD where name = \"$itemString \"";
      $result = $db->query("$query");
      if($result->num_rows > 0) {
        $row = $result->fetch_array();
        foreach($row as $key=>$val):
          if($key == "item_id") {
            $item_id = $val;
          } else if($key == "quantity") {
            $quantity = $val;
          }
        endforeach;
        $newQuantity = $quantity + $quantityToAdd;
        $newQuery = "Update Item set quantity = \"$newQuantity\" where item_id = \"$item_id\"";
        $result = $db->query("$newQuery");
        echo "Thank you, $quantityToAdd units of $itemString have been received";
      } else {
        echo "We don't have that item in the store. Sorry, but we cannot accept your item";
      }
    } else if($category == "videogames") {
      $query = "Select * from Item Natural Join video_game where name = \"$itemString \"";
      $result = $db->query("$query");
      if($result->num_rows > 0) {
        $row = $result->fetch_array();
        foreach($row as $key=>$val):
          if($key == "item_id") {
            $item_id = $val;
          } else if($key == "quantity") {
            $quantity = $val;
          }
        endforeach;
        $newQuantity = $quantity + $quantityToAdd;
        $newQuery = "Update Item set quantity = \"$newQuantity\" where item_id = \"$item_id\"";
        $result = $db->query("$newQuery");
        echo "Thank you, $quantityToAdd units of $itemString have been received";
      } else {
        echo "We don't have that item in the store. Sorry, but we cannot accept your item";
      }
    } else if($category == "movies") {
      $query = "Select * from Item Natural Join movie where title = \"$itemString \"";
      $result = $db->query("$query");
      if($result->num_rows > 0) {
        $row = $result->fetch_array();
        foreach($row as $key=>$val):
          if($key == "item_id") {
            $item_id = $val;
          } else if($key == "quantity") {
            $quantity = $val;
          }
        endforeach;
        $newQuantity = $quantity + $quantityToAdd;
        $newQuery = "Update Item set quantity = \"$newQuantity\" where item_id = \"$item_id\"";
        $result = $db->query("$newQuery");
        echo "Thank you, $quantityToAdd units of $itemString have been received";
      } else {
        echo "We don't have that item in the store. Sorry, but we cannot accept your item";
      }
    }
    ?>
  </body>
</html>
