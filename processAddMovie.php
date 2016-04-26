<?php

	include 'databaseinfo.php'; //database information to access MySQL


  if (isset($_POST['movieName'])){
    $movieName = $_POST['movieName'];

  }

  if (isset($_POST['director'])){	
    $director = $_POST['director'];
  }

  if (isset($_POST['genre'])){
    $genre = $_POST['genre'];
  }

  if (isset($_POST['rating'])){
	 $rating = $_POST['rating'];
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



    $movieQuery = $db->prepare("INSERT INTO movie(item_id, title, director, genre, rating) values(?, ?, ?, ?, ?)");

    $movieQuery->bind_param("dssss", $itemId, $movieName, $director, $genre, $rating); 

    $movieQuery->execute();

        // printf("Can't enter data into the video game table: %s.\n", $db->error);


    $movieQuery->close();
    $itemQuery->close();
    $db->close();

 



?>