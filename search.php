<?php

	include 'databaseinfo.php';

	if(isset($_GET['keywords'])){
		foo = "poop $keywords = $db->escape_string($_GET['keywords'])";
		
		$query = $db->query("
			SELECT title
			FROM video_game
			WHERE title LIKE '%{$keywords}%' 	
			");
			?>

			<div class="result-count">
			Found <?php echo $query->num_rows; ?> results;
			</div>

	}