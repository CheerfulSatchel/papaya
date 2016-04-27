<?php ini_set('display_errors', 1); ?>

<?php 
 	include 'databaseInfo.php';


 	//get all the rows in the mysql database
 	$stmt = $db->prepare("select item.item_id, movie.title, movie.genre, movie.director, actors.actor_names, movie.rating, item.price, item.quantity FROM (movie NATURAL JOIN item NATURAL JOIN actors) ORDER BY movie.title, movie.director, actors.actor_names, movie.genre, movie.rating");
    $stmt->execute();

        // printf("Error: %s.\n", $stmt->error);


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


