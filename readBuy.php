<?php ini_set('display_errors', 1); ?>

<?php
  session_start();
 	include 'databaseinfo.php';
 	//get all the rows in the mysql database
  $email = "tj@virginia.edu";
  //$email = $_POST['userName'];
 	$stmt = $db->prepare("SELECT * FROM Buy NATURAL JOIN item NATURAL JOIN movie WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $MovieResult = $stmt->get_result();

  $stmt = $db->prepare("SELECT * FROM Buy NATURAL JOIN item NATURAL JOIN video_game WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $VideoGameResult = $stmt->get_result();

  $stmt = $db->prepare("SELECT * FROM Buy NATURAL JOIN item NATURAL JOIN song WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $CDResult = $stmt->get_result();

 	mysqli_stmt_close($stmt);

 	$jsonArray = array();
  //$jsonArrayVideoGame = array();
  //$jsonArrayCD = array();
 	header('Content-Type: application/json'); // This line will make your ajax be okay with the json response

 	while($row = mysqli_fetch_assoc($MovieResult)) { //Returns an associative array of strings representing fetched row in the result set with each key being the name of the field
        $jsonArray[] = $row;
  }

  while($row = mysqli_fetch_assoc($VideoGameResult)) { //Returns an associative array of strings representing fetched row in the result set with each key being the name of the field
        //$jsonArrayVideoGame[] = $row;
        $jsonArray[] = $row;
  }

  while($row = mysqli_fetch_assoc($CDResult)) { //Returns an associative array of strings representing fetched row in the result set with each key being the name of the field
        //$jsonArrayCD[] = $row;
        $jsonArray[] = $row;
  }

  echo json_encode($jsonArray);
?>
