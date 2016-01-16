<?php
require './classes/AutoLoad.php';
$db = new DataBase();
$usuarioManager = new ManageUser($db);

$usuario;

$sesion = new Session();
if($sesion->isLogged()){
	$usuario = $usuarioManager->get($sesion->getUser());
} else {
	$sesion->sendRedirect("login.php");
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Log In</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
		<nav>
			<a href="index.php"><img src="resources/logo.png" class="logo"/></a>
			<a href="php/phplogout.php" class="link">Logout</a>
		</nav>
   		
   		<div class="index">
			<div class="usuario">
				<h class="user"><?php echo $usuario->getAlias(); ?></h>
				<img src="<?php echo $usuario->getImage(); ?>"/>
				<h>Email: <span><?php echo $usuario->getEmail(); ?></span></h>
				<h>Signin: <span><?php echo $usuario->getSignindate(); ?></span></h>
				<div class="clear"></div>
			</div>
  			<div class="content">
  				<h class="email<?php echo $usuario->getAlive(); ?>">You must activate your account</h>
				<form action="php/phpeditemail.php" method="post">
					<br/><br/><br/>
					<fieldset>
						<legend>Change email</legend><br/>
						<input type="email" name="email" value="<?php echo $usuario->getEmail(); ?>"/>
						<input type="submit" value="Change" id="guardarperfil"/>
					</fieldset>
				</form>
				<form action="php/phpeditpassword.php" method="post">
					<br/><br/><br/>
					<fieldset>
						<legend>Change password</legend><br/>
						Old <input type="password" name="pass" value=""/>
						<br/><br/>
						New <input type="password" name="newpass" value=""/>
						<br/><br/>
						Rep <input type="password" name="newpass2" value=""/>
						<br/><br/>
						<input type="submit" value="Change" id="guardarperfil"/>
					</fieldset>
				</form>
				<form action="php/phpeditimage.php" method="post" enctype="multipart/form-data">
					<br/><br/><br/>
					<fieldset>
						<legend>Change profile image</legend><br/>
						<input type="file" name="image" class="file"/>
						<input type="submit" value="Change" id="guardarperfil"/>
					</fieldset>
				</form>
			</div>
   		</div>
   		
   		<footer>
   			<h class="left">Copyright by Socializate</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>

<?php
$db->close();