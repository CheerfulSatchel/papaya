<?php


	include 'databaseinfo.php'; //database information to access MySQL

	if (isset($_POST['email'])){
    	$email = $_POST['email'];
  	}
  	echo $email;


  $stmt = $db->prepare("SELECT * FROM Buy WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0) {
  	$rows = $result->num_rows;




  $insertSell = $db->prepare("INSERT INTO sell(item_id, email, count, timestamp) values(?, ?, ?, ?)");

   $insertSell->bind_param("dsds", $item_id, $email, $count, $timestamp);

  // $updateCount = $db->prepare("UPDATE item SET item.quantity = item.quantity - 1 WHERE item_id = ?");

  // $updateCount->bind_param("d", $item_id);


  	while($row = $result->fetch_array()){

  		$item_id = $row['item_id']; 

  		$email = $row['email'];

  		$count = $row['Count'];

  		$timestamp = $row['timestamp'];


  		$insertSell->execute();

 		// $updateCount->execute() or die('update count failed: ' . ($db->error));


		 echo $row['email']. " - ". $row['item_id'] . " - ". $row['Count'] ;
		echo "<br />";
}


	$deletefrombuyQuery = $db->prepare("DELETE FROM Buy WHERE email = ?");

    $deletefrombuyQuery->bind_param("s",$email); 

    $deletefrombuyQuery->execute();    

    $deletefrombuyQuery->close();

	$insertSell->close();
    // $updateCount->close();
    $db->close();

    echo "Yay";




  }

  ?>