<?php

	include 'databaseinfo.php';

	if(isset($_GET['keywords'])){
		$keywords = $db->escape_string($_GET['keywords']);
		
		$query = $db->query("
			SELECT title
			FROM video_game
			WHERE body LIKE '%{$keywords}%'
			OR title LIKE '%{$keywords}%' 	
			");
			?>

			<div class="result-count">
			Found <?php echo $query->num_rows; ?> results;
			</div>

	}