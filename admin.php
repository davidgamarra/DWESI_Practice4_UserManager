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

$pagination = false;
if($usuarioManager->count() > 6){
	$page = Request::get("page");
	if($page === null){
		$page = 1;
	}
	$pagination = true;
	$pager = new Pager($usuarioManager->count(), 6, $page);
}

if(!$pagination){
	$usuarios = $usuarioManager->getList(1, "email", $usuarioManager->count());
} else {
	$usuarios = $usuarioManager->getList($page, "email", 6);
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Socializate</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
		<nav>
			<a href="index.php"><img src="resources/logo.png" class="logo"/></a>
			<a href="php/phplogout.php" class="link">Logout</a>
		</nav>
   		
   		<div class="users">
   			<?php foreach($usuarios as $index => $usuario) { ?>
			<a href="edituser.php?email=<?php echo $usuario->getEmail(); ?>"><div class="usuario">
				<h class="user"><?php echo $usuario->getAlias(); ?></h>
				<img src="<?php echo $usuario->getImage(); ?>"/>
				<h>Email: <span><?php echo $usuario->getEmail(); ?></span></h>
				<h>Signin: <span><?php echo $usuario->getSignindate(); ?></span></h>
				<div class="clear"></div>
			</div></a>
  			<?php } ?>
   			
   			<div class="clear"></div>
   			
   			<?php if($pagination){ ?>
			<div class="pagination">
				<a href="?page=<?= $pager->getFirst() ?>">&lt;&lt; </a>
				<a href="?page=<?= $pager->getPrevious() ?>">&lt; </a>
				<a href="?page=<?= $pager->getLast() ?>">&gt;&gt; </a>
				<a href="?page=<?= $pager->getNext() ?>">&gt; </a>
			</div>
			<?php } ?>
  			<div class="clear"></div>
   		</div>
   		
   		<footer>
   			<h class="left">Copyright by Socializate</h>
   			<h class="right">Designed by David Gamarra</h>
   		</footer>
    </body>
</html>

<?php
$db->close();