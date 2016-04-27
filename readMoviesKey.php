<?php
  ini_set('display_errors', 1);
 	include 'databaseInfo.php';
  $keyword = $_POST['keyword'];

  $editMovieQuery= $db->prepare("UPDATE movie SET title= ?, director= ?, rating= ?, genre=? WHERE item_id= ?") or die("Your movie update couldn't be done: " . $db->error); //Update the movie's properties for the unique game

   $editMovieQuery->bind_param("ssssd", $movieName, $director, $rating, $genre, $id);

   $editMovieQuery->execute();

 	//get all the rows in the mysql database
 	$stmt = $db->prepare("select item.item_id, movie.title, movie.genre, movie.director, movie.rating, item.price, item.quantity FROM (movie NATURAL JOIN item)
  ORDER BY movie.title, movie.director, movie.genre, movie.rating WHERE movie.title LIKE '%{$keyword}%'");");
    $stmt->execute();

    $result = $stmt->get_result();
 	$rows = $result->num_rows;

 	mysqli_stmt_close($stmt);

 	$jsonArray = array();
 	      	header('Content-Type: application/json'); // This line will make your ajax be okay with the json response


 	while($row = mysqli_fetch_assoc($result)) { //Returns an associative array of strings representing fetched row in the result set with each key being the name of the field
        $jsonArray[] = $row;


    }

    echo json_encode($jsonArray);

?>
