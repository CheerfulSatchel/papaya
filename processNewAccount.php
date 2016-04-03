<!DOCTYPE html>
<html>
  <head>
    <title> Processing </title>
  </head>
  <body>
    <?php
      if(isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        echo "New $email and $password";

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

        $db->query("insert into user values(\"$email\", \"$password\", \"$street\",
        \"$city\", \"$state\", \"$zipcode\")");
      }
    ?>
  </body>
</html>
