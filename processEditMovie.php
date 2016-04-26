<?php

	include 'databaseinfo.php'; //database information to access MySQL

  if (isset($_POST['id'])){
    $id = $_POST['id'];

  }  

  if (isset($_POST['movieName'])){
    $movieName = $_POST['movieName'];

  }

  if (isset($_POST['director'])){	
    $director = $_POST['director'];
  }

  if (isset($_POST['rating'])){
    $rating = $_POST['rating'];
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


   $editMovieQuery= $db->prepare("UPDATE movie SET title= ?, director= ?, rating= ?, genre=? WHERE item_id= ?") or die("Your movie update couldn't be done: " . $db->error); //Update the movie's properties for the unique game

    $editMovieQuery->bind_param("ssssd", $movieName, $director, $rating, $genre, $id); 

    $editMovieQuery->execute();

    // printf("Can't enter into the item table: %s.\n", $db->error);



    $editItemQuery = $db->prepare("UPDATE item SET price= ?, quantity =? WHERE item_id= ?");

    $editItemQuery->bind_param("ssd", $price, $quantity, $id); 

    $editItemQuery->execute();

        // printf("Can't enter data into the video movie table: %s.\n", $db->error);


    $editMovieQuery->close();
    $editItemQuery->close();
    $db->close();

 



?>