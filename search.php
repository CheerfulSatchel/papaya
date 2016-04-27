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
	$_SESSION['keyword'] = $keyword;

	if($category == "Movies") {
		header("Location: moviesKeySearch.php");
	} else if ($category == "Video games") {
		header("Location: videoGamesKeySearch.php");
	} else if ($category == "Music") {
		header("Location: songsKeySearch.php");
	}

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
