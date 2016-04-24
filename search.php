<?php

	require_once 'databaseinfo.php';

	if(isset($_GET['keywords'])){
		echo $keywords = $_GET['keywords'];
	}