<?php
  session_start();
	$category = "none";
	$keyword = "none";
	if(isset($_POST['category'])) {
		$category = $_POST['category'];
	}
	echo "$category";
	if(isset($_POST['keywords'])) {
		$keyword = $_POST['keywords'];
	}
	echo "$keyword";
	/*if(isset($_POST['category'])) {
		$category = $_POST['category'];
		if(isset($_GET['keywords'])) {
			$keyword = $_GET['keywords'];
			$_SESSION['keyword'] = $keyword;
		} else {
			echo "Keyword was not set";
		}
		if($category == "movies") {
			header("Location: moviesKeySearch.html");
		} else if ($category == "video games") {
			header("Location: videoGamesKeySearch.html");
		} else if ($category == "songs") {
			header("Location: songsKeySearch.html");
		}
	}*/
?>

<?php //ini_set('display_errors', 1); ?>

<!--<html>
	<head>
		<title>
			Search Results
		</title>
	</head>
		<link rel="stylesheet" href="css/skel.css" />
 		<link rel="stylesheet" href="css/style.css" />
 		<link rel="stylesheet" href="css/style-xlarge.css" />

<?php

	/*include 'databaseInfo.php';

	if(isset($_GET['keywords'])){
		$keywords = $db->escape_string($_GET['keywords']);
		$videogamequery = $db->query("
			SELECT title
			FROM video_game
			WHERE title LIKE '%{$keywords}%'
			");
		$songquery = $db->query("
			SELECT name
			FROM song
			WHERE name LIKE '%{$keywords}%'
			");
			?>

			<div class="result-count">
				Found <?php echo $videogamequery->num_rows; ?> result(s) in video games.
			</div>
<?php

	if($videogamequery->num_rows){
		while($r = $videogamequery->fetch_object()){
		?>
			<div class="videogameresult">
			<a href="#"><?php echo $r->title; ?></a>
			</div>
		<?php
		}
	}
?>
	<div class="result-count">
				Found <?php echo $songquery->num_rows; ?> result(s) in songs.
			</div>
<?php
	if($songquery->num_rows){
		while($r = $songquery->fetch_object()){
		?>
			<div class="songresult">
			<a href="#"><?php echo $r->name; ?></a>
			</div>
		<?php
		}
	}

} ?>




</html>
*/
