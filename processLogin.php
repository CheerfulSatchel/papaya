<!DOCTYPE html>
<html>
  <head>
    <title> Processing </title>
  </head>
  <body>
    <?php
    session_start();

     //Database parameters
            $server = "stardock.cs.virginia.edu";
            $username = "cs4750mjm5qu";
            $password = "snowball";
            $db_name = "cs4750mjm5qu";
            $db = new mysqli("$server", "$username", "$password", "$db_name");

      if(isset($_POST['email']) && isset($_POST['password'])) {
      	$user = trim($_POST['email']);
 	  	$password = trim($_POST['password']);
 	  	$hashed_password = md5($password);
      // echo $hashed_password;
      echo "<br />";


 	  	$query = "select * from user where user.email= '$user' and user.password = '$hashed_password'"; //see if the user name and password were foudn in the table
 	  	$result = $db->query($query);
 	  	$rows = $result->num_rows;


 	  	if ($rows < 1){ //there were no rows found with this email and password
 			$_SESSION['loginError'] = "The email or password that you used to login were not found in our server. Please try again. <br />";
   			if (isset($_SESSION['login'])) {
  	 			 	unset($_SESSION['login']);
  	 			}

  	 		header("Location: login.php"); //redirect to the login page
  	 	}

	 	else{
	 		header("Location: index.html"); //redirect to the successful login page

	 	}


}

?>
  </body>
</html>
