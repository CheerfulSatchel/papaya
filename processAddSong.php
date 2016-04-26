<?php ini_set('display_errors', 1); ?>

<?php

	include 'databaseinfo.php'; //database information to access MySQL


  if (isset($_POST['songName'])){
    $songName = $_POST['songName'];

  }

  if (isset($_POST['artist'])){	
    $artist = $_POST['artist'];
  }

  if (isset($_POST['length'])){
    $length = $_POST['length'];
  }

  if (isset($_POST['release_year'])){
	 $release_year = $_POST['release_year'];
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



    $songQuery = $db->prepare("INSERT INTO song(item_id, name, artist, length, release_year) values(?, ?, ?, ?, ?)");

    $songQuery->bind_param("dssss", $itemId, $songName, $artist, $length, $release_year); 

    $songQuery->execute();

        // printf("Can't enter data into the video game table: %s.\n", $db->error);


    $songQuery->close();
    $itemQuery->close();
    $db->close();

 



?>