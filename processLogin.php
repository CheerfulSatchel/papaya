<?php ini_set('display_errors', 1); ?>

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



      $stmt = $db->prepare("select * from user where user.email= ? and user.password = ?");

      $stmt->bind_param("ss", $user, $hashed_password);

      $stmt->execute();


 	  	// $query = "select * from user where user.email= '$user' and user.password = '$hashed_password'"; //see if the user name and password were foudn in the table
 	  	// $result = $s->query($query);
      $result = $stmt->get_result();
 	  	$rows = $result->num_rows;


      mysqli_stmt_close($stmt);
      mysqli_close($mysqli);

 	  	if ($rows < 1){ //there were no rows found with this email and password
 			$_SESSION['loginError'] = "The email or password that you used to login were not found in our server. Please try again. <br />";
   			if (isset($_SESSION['login'])) {
  	 			 	unset($_SESSION['login']);
  	 			}

  	 		header("Location: login.php"); //redirect to the login page
  	 	} else {

        $_SESSION['email'] = $user;

        if (($_POST['email'].trim()) == "admin@gmail.com") {
          header("Location: admin.html");
        }

	 	   else{

	 		  header("Location: index.html"); //redirect to the successful login page

	 	 }
    }



}

?>
  </body>
</html>
