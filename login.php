<!DOCTYPE html>
<html>
 <head>


  <link rel="stylesheet" type="text/css" href="loginStyle.css"/>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">





</script>

  <title>Login</title>
 </head>
 <body>
	




 	<br />
 	<form align="left" action="processlogin.php" method="POST">
		<input type = "email" name = "email" placeholder='Email'>

		<input type = "password" name = "password" placeholder='Password'>
		
		<input type = "submit" name = 'submit' value = "Login"> </form>
	
	<br /> </br>
	

<button type="button" onclick="location.href='forgotPassword.php';">Forgot Password</button>

<button type="button" onclick="location.href='createAccount.php';">Create an Account</button>

<br />

<br />


</body>
</html>