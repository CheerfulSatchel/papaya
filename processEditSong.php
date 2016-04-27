<?php ini_set('display_errors', 1); ?>

<?php

	include 'databaseinfo.php'; //database information to access MySQL

  if (isset($_POST['id'])){
    $id = $_POST['id'];

  }  

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




   $editSongQuery= $db->prepare("UPDATE song SET name= ?, artist= ?, length= ?, release_year=? WHERE item_id= ?") or die("Your song update couldn't be done: " . $db->error); //Update the movie's properties for the unique game

    $editSongQuery->bind_param("ssssd", $songName, $artist, $length, $release_year, $id); 

    $editSongQuery->execute();

    // printf("Can't enter into the item table: %s.\n", $db->error);



    $editItemQuery = $db->prepare("UPDATE item SET price= ?, quantity =? WHERE item_id= ?");

    $editItemQuery->bind_param("ssd", $price, $quantity, $id); 

    $editItemQuery->execute();

        // printf("Can't enter data into the video movie table: %s.\n", $db->error);


    $editSongQuery->close();
    $editItemQuery->close();
    $db->close();

 



?>