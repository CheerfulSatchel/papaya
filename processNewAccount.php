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
        echo "New $email and $password";
      }
    ?>
  </body>
</html>
