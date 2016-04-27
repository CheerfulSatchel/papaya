<?php
  ini_set('display_errors', 1);
 	include 'databaseInfo.php';
  $keyword = $_POST['keyword'];
    // $keyword = "ing";
  $preparedString = "%" . $keyword . "%";


 	//get all the rows in the mysql database
 	$stmt = $db->prepare(
    "SELECT item.item_id, movie.title, movie.rating, actors.actor_names,movie.genre, movie.director, movie.rating, item.price 
    FROM (movie NATURAL JOIN item NATURAL JOIN actors)
    WHERE movie.title LIKE ?
    OR movie.director LIKE ?
    OR actors.actor_names LIKE ? 
    OR movie.genre LIKE ?
        ORDER BY movie.title, movie.director, actors.actor_names, movie.genre, movie.rating ");

    $stmt->bind_param("ssss", $preparedString, $preparedString, $preparedString, $preparedString);

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
