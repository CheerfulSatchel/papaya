<!DOCTYPE html>
<html>
 <head>
  <title>Login</title>
 </head>
 <link rel="stylesheet" href="css/skel.css" />
 <link rel="stylesheet" href="css/style.css" />
 <link rel="stylesheet" href="css/style-xlarge.css" />
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
	

<input type="button" onclick="location.href='forgotPassword.php';" value = "Forgot Password">

<input type="button" onclick="location.href='createAccount.php';" value = "Create an Account">

<br />

<br />


</body>
</html>