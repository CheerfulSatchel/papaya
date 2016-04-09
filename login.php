<!DOCTYPE html>
<html>
 <head>
  <title>Login</title>
 </head>
 <body>
	
<?php
session_start();


if (isset($_SESSION['loginError'])) { //Displays the message for when the user wasn't able to login b/c they entered the wrong email or password
	print $_SESSION['loginError'];
	unset($_SESSION['loginError']);
}


if (isset($_SESSION['registerSuccessful'])) { //Displays the message for when a new account has been registered
	print $_SESSION['registerSuccessful'];
	unset($_SESSION['registerSuccessful']);
}

if (isset($_SESSION['login'])) {
	header("Location: index.html"); //redirect to the successful login page
}
	?>




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