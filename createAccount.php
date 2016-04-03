<!DOCTYPE html>
<html>
  <head>
    <title> Create Account </title>
  </head>
  <body>
    <h3> Please enter an email and password </h3>
    <form method="POST" action="processNewAccount.php">
      Email: <input type = "text" name = "email" value=""> <br/> <br/>
      Password: <input type = "text" name = "password" value=""> <br/> <br/>
      Street: <input type = "text" name = "street" value = ""> <br/> <br/>
      City: <input type = "text" name = "city" value = ""> <br/> <br/>
      State: <input type = "text" name = "state" value = ""> <br/> <br/>
      Zipcode: <input type = "text" name = "zipcode" value = ""> <br/> <br/>
      <input type="submit" name="Submit" value="Submit">
    </form>
  </body>
</html>
