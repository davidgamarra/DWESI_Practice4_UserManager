<?php
require './classes/AutoLoad.php';
$sesion = new Session();
if($sesion->isLogged()){
	$sesion->sendRedirect();
} 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Manager</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
		<nav>
			<img src="resources/logo.png" class="logo"/>
		</nav>
   		
   		<div class="login">
   			<img src="resources/bg_login.jpg" class="background"/>
   			<form action="php/phplogin.php" method="post" id="formlogin">
   				<label for="user">Email</label>
   				<input type="email" name="user" id="user"/>
   				<label for="psw">Password</label>
   				<input type="password" name="psw" id="psw"/>
   				<input type="submit" value="Log In" id="log"/>
   				<div class="clear"></div>
   			</form>
   			
   			<form action="emailpassword.php" method="post" id="formlogin">
   				<label for="user">Email</label>
   				<input type="email" name="email" id="user"/>
   				<input type="submit" value="Recovery password" id="rec"/>
   				<div class="clear"></div>
   			</form>
   			
   			<form action="php/phpsignin.php" method="post" id="formregister">
   				<label for="email">Email</label>
   				<input type="email" name="email" id="email"/>
   				<label for="psw1">Password</label>
   				<input type="password" name="psw1" id="psw1"/>
   				<label for="psw2">Confirm</label>
   				<input type="password" name="psw2" id="psw2"/>
   				<input type="submit" value="Sign In" id="reg"/>
   				<div class="clear"></div>
   			</form>
			
   		</div>
   		
   		<footer>
   			<h class="left">Copyright by UserManager</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>