<?php

	include 'databaseinfo.php'; //database information to access MySQL


  if (isset($_POST['gameName'])){
    $gameName = $_POST['gameName'];

  }

  if (isset($_POST['publisher'])){	
    $publisher = $_POST['publisher'];
  }

  if (isset($_POST['rating'])){
    $rating = $_POST['rating'];
  }

  if (isset($_POST['platform'])){
	 $platform = $_POST['platform'];
  }

  if (isset($_POST['genre'])){
	 $genre = $_POST['genre'];
   }

  if (isset($_POST['price'])){
  $price = $_POST['price'];
}

 
  if (isset($_POST['quantity'])){
  $quantity = $_POST['quantity'];
}


    $itemQuery = $db->prepare("INSERT INTO item(price, quantity) VALUES (?, ?)"); //Insert the price and quantity into the item table. The item_id column automatically increments every time an entry is added.

    $itemQuery->bind_param("ss",$price, $quantity); 

    $itemQuery->execute();

    // printf("Can't enter into the item table: %s.\n", $db->error);


    $itemId = $itemQuery->insert_id;



    $videoGameQuery = $db->prepare("INSERT INTO video_game(item_id, title, publisher, rating, platform, genre) values(?, ?, ?, ?, ?, ?)");

    $videoGameQuery->bind_param("dsssss", $itemId, $gameName, $publisher, $rating, $platform, $genre); 

    $videoGameQuery->execute();

        // printf("Can't enter data into the video game table: %s.\n", $db->error);


    $videoGameQuery->close();
    $itemQuery->close();
    $db->close();

 



?>