<!DOCTYPE html>
<html>
  <head>
    <title> Create Account </title>
  </head>
  <body>

<style type="text/css">
    label{
        display: inline-block;
        float: left;
        clear: left;
        width: 80px;
        text-align: right;
        font-weight:bold;
    }

    </style>

    <h3> Enter the following information to register a new account! </h3>
    <form method="POST" action="processNewAccount.php">
      <label>Email:  </label> <input type = "text" name = "email" value=""> <br/> <br/>
      <label>Password:  </label> <input type = "text" name = "password" value=""> <br/> <br/>
      <label>Street:  </label> <input type = "text" name = "street" value = ""> <br/> <br/>
      <label>City:  </label> <input type = "text" name = "city" value = ""> <br/> <br/>
      <label>State:  </label> <input type = "text" name = "state" value = ""> <br/> <br/>
      <label>Zipcode:  </label> <input type = "text" name = "zipcode" value = ""> <br/> <br/>
      <input type="submit" name="Submit" value="Submit">
    </form>
  </body>
</html>
