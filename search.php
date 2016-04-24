<html>
	<head>
		<title>
			Search Results
		</title>
	</head>
	
	<style>
			a:link{
				color: Green;
				text-decoration: none;
			}
			a:hover{
				color: Green;
				text-decoration: underline;
			}
			a:active{
				color: Blue;
				text-decoration: none
			}
			a:visited{
				color: Green;
				text-decoration:none;
			}
		</style>
<?php

	include 'databaseInfo.php';
	 
	if(isset($_GET['keywords'])){
		$keywords = $db->escape_string($_GET['keywords']);
		$query = $db->query("
			SELECT title
			FROM video_game
			WHERE title LIKE '%{$keywords}%' 	
			");
			?>

			<div class="result-count">
			Found <?php echo $query->num_rows; ?> results, hooray!;
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