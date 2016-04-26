<?php
$server = "stardock.cs.virginia.edu";
$username = "cs4750mjm5qu";
$password = "snowball";
$db_name = "cs4750mjm5qu";
$db = new mysqli("$server", "$username", "$password", "$db_name");

$query = "Select * from User";

if ($db->connect_error):
  die("Connection error: " . $db->connect_error);
endif;

$res = $db->query("$query");
$rows = $res->num_rows;

echo "$rows";
 ?>
