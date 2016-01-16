<?php
require './classes/AutoLoad.php';
$db = new DataBase();
$usuarioManager = new ManageUser($db);

$user;

$sesion = new Session();
if($sesion->isLogged()){
	$user = $usuarioManager->get($sesion->getUser());
	if($user->getAdmin() === 0){
	    $session->destroy();
	    $session->sendRedirect("login.php");
	}
} else {
	$sesion->sendRedirect("login.php");
}

$email = Request::get("email");
$usuario = $usuarioManager->get($email);

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
				<form action="php/phpedituser.php" method="post" enctype="multipart/form-data">
					<br/><br/><br/>
					<fieldset>
						<legend>Edit user</legend><br/>
						<input type="hidden" name="email" value="<?php echo $usuario->getEmail(); ?>"/>
						Email: <input type="email" name="newemail" value="<?php echo $usuario->getEmail(); ?>"/>
						<br/><br/>
						Password: <input type="password" name="pass" value=""/>
						<br/><br/><br/>
						<input type="file" name="image" class="file"/>
						<br/><br/>
						<?php 
						$alive = ""; $worker = ""; $admin = "";
						if($usuario->getAlive() == 1){
						    $alive = "checked";
						}
						if($usuario->getWorker() == 1){
						    $worker = "checked";
						}
						if($usuario->getAdmin() == 1){
						    $admin = "checked";
						}
						?>
						<input type="checkbox" name="alive" value="1" <?php echo $alive ?>> Alive<br>
						<br/><br/>
						<input type="checkbox" name="worker" value="1" <?php echo $worker ?>> Worker<br>
						<br/><br/>
						<input type="checkbox" name="admin" value="1" <?php echo $admin ?>> Admin<br>
						<br/><br/>
						<input type="submit" value="Save" id="guardarperfil"/>
					</fieldset>
				</form>
				<form action="php/phpdeleteuser.php" method="post">
					<br/><br/><br/>
					<fieldset>
						<legend>Delete user</legend><br/>
						<input type="hidden" name="email" value="<?php echo $usuario->getEmail(); ?>"/>
						<input type="checkbox" name="confirm" value="yes"> Confirm delete user<br>
						<input type="submit" value="Delete" id="eliminarmensaje"/>
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