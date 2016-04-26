<?php ini_set('display_errors', 1); ?>

<?php
session_start();
if(session_destroy())
{
header("Location: index.html");
}
?>