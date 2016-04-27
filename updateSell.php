<?php

	include 'databaseinfo.php'; //database information to access MySQL

	if (isset($_POST['email'])){
    	//$email = $_POST['email'];
  	}
  	$email = "tj@virginia.edu";


  $stmt = $db->prepare("SELECT * FROM Buy WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0) {
  	$rows = $result->num_rows;




  $insertSell = $db->prepare("INSERT INTO sell(item_id, email, count, timestamp) values(?, ?, ?, ?)");

   $insertSell->bind_param("dsds", $item_id, $email, $count, $timestamp);


  	while($row = $result->fetch_array()){

  		$item_id = $row['item_id']; 

  		$email = $row['email'];

  		$count = $row['Count'];

  		$timestamp = $row['timestamp'];


  		$insertSell->execute() or die();

		 echo $row['email']. " - ". $row['item_id'] . " - ". $row['Count'] ;
		echo "<br />";
}

  	// for($i = 0; $i < $rows; $i++) {

  	
  }

  ?>