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
  	for($i = 0; $i < $rows; $i++) {
  		$row = $result -> fetch_array();
  		print_r($row);
  		foreach($row as $key=>$val) {
  			if($key == "item_id") {
  				echo "$val";	
  			} else if($key == "Count") {
  				echo "$val";
  			}
  		}
  	}
  }