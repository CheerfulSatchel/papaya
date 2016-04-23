<?php

	include 'databaseinfo.php'; //database information to access MySQL

  if (isset($_POST['id'])){
    $id = $_POST['id'];

  }  

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

// echo $id;

// echo $gameName;

// echo "";

// echo $publisher;

// echo "";

// echo $rating;

// echo "";

// echo $genre;

// echo "";

// echo $price;

// echo "";


// echo $quantity;


// echo "";


   $videoGameQuery= $db->prepare("UPDATE video_game SET title= ?, publisher= ?, rating= ?, platform=?, genre=? WHERE item_id= ?") or die("Your video_game update couldn't be done: " . $db->error); //Update the game's properties for the unique game

    $videoGameQuery->bind_param("sssssd", $gameName, $publisher, $rating, $platform, $genre, $id); 

    $videoGameQuery->execute();

    // printf("Can't enter into the item table: %s.\n", $db->error);



    $itemQuery = $db->prepare("UPDATE item SET price= ?, quantity =? WHERE item_id= ?");

    $itemQuery->bind_param("ssd", $price, $quantity, $id); 

    $itemQuery->execute();

        // printf("Can't enter data into the video game table: %s.\n", $db->error);


    $videoGameQuery->close();
    $itemQuery->close();
    $db->close();

 



?>