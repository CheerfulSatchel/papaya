<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$id = $_POST['id'];



	// $itemQuery = "DELETE FROM item
	// 	WHERE item_id= ?";

	$itemQuery = $db->prepare("DELETE FROM item WHERE item_id= ?") or die("Your item deletion couldn't be done: " . $db->error);

    $itemQuery->bind_param("d",$id); 

    $itemQuery->execute();    

    $itemQuery->close();
    $db->close();


?>

