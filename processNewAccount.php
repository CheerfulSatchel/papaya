<!DOCTYPE html>
<html>
  <head>
    <title> Processing </title>
  </head>
  <body>
    <?php
    session_start();

      if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = md5($password); //Hashes the password using the default crypt hash algorithm
        // echo $hashed_password;
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        // echo "New $email and $password";

        //Database parameters
        $server = "stardock.cs.virginia.edu";
        $username = "cs4750mjm5qu";
        $password = "snowball";
        $db_name = "cs4750mjm5qu";
        $db = new mysqli("$server", "$username", "$password", "$db_name");

        //Try to connect
			  if ($db->connect_error){
				  die("Connection error: " . $db->connect_error);
			  }

        // $db->query("insert into user values(\"$email\", \"$hashed_password\", \"$street\",
        // \"$city\", \"$state\", \"$zipcode\")");

        $stmt = $db->prepare("insert into user values(?, ?, ?, ?, ?, ?)"); //Make a prepared statement to avoid sql injection attacks

        $stmt->bind_param("ssssss",$email, $hashed_password, $street, $city, $state, $zipcode); //Need to have 7 parameters, the types (aka "s" for string or "d" for digit), and the variables you want to enter

        $stmt->execute();

        $stmt->close();
        $db->close();
 
        $_SESSION['registerSuccessful'] = "You have created a new account!"; //Creates a message notifying the user that they created a new account

        header("Location: login.php"); //redirect to the successful login page


      }

    ?>
  </body>
</html>
