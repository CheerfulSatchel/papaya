<html>
	<head>
		<title>
			Search Results
		</title>
	</head>
		<link rel="stylesheet" href="css/skel.css" />
 		<link rel="stylesheet" href="css/style.css" />
 		<link rel="stylesheet" href="css/style-xlarge.css" />
<?php

	include 'databaseInfo.php';
	 
	if(isset($_GET['keywords'])){
		$keywords = $db->escape_string($_GET['keywords']);
		$query = $db->query("
			SELECT title
			FROM video_game
			WHERE title LIKE '%{$keywords}%' 	
			");
		$query2 = $db->query("
			SELECT name
			FROM CD
			WHERE name LIKE '%{$keywords}%' 
			");
			?>

			<div class="result-count">
			Found <?php echo $query->num_rows; ?> results, hooray!
			Found <?php echo $query2->num_rows; ?> results, hooray!
			</div>

<?php

	if($query->num_rows){
		while($r = $query->fetch_object()){
		?>
			<div class="result">
			<a href="#"><?php echo $r->title; ?></a>
			</div>	
		<?php
		}
	}
} ?>

</html>