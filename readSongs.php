<?php ini_set('display_errors', 1); ?>

<?php 
 	include 'databaseInfo.php';


 	//get all the rows in the mysql database
 	$stmt = $db->prepare("select item.item_id, song.name, song.artist, song.length, song.release_year, item.price, item.quantity FROM (song NATURAL JOIN item) ORDER BY song.name, song.artist, song.length, song.release_year");
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

