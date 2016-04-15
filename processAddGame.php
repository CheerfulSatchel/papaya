<?php
	include 'databaseinfo.php'; //database information to access MySQL

	$gameName = $_POST['gameName'];

	$platform = $_POST['platform'];

	$genre = $_POST['genre'];
    
  $price = $_POST['price'];
  	
  $quantity = $_POST['quantity'];
   	
   

    



  $gameQuery = "INSERT INTO clientmain (firstName, lastName, phone, email, workplace, chf1, chf2, nextMeeting, nextPayment, principal)
        VALUES('$firstName', '$lastName','$phone', '$email', '$workplace', '$chf1', '$chf2', '$dateConverted', '$payment', '$principal')";
	$result = $db->query($clientMainQuery) or die("Your main client query couldn't be done: " . $db->error);

    $id = $db->insert_id;

    $clientMoreQuery = "INSERT INTO clientmore (gender, age, race, income, address, city, state, id)
        VALUES('$gender', '$age', '$race', '$income', '$address', '$city', '$state', '$id')";

        $result = $db->query($clientMoreQuery) or die("Your personal information query couldn't be done: " . $db->error);
    



?>