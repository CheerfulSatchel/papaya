<?php

	include 'databaseinfo.php';

	if(isset($_GET['keywords'])){
		echo $keywords = $_GET['keywords'];
	}