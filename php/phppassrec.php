<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);

$email = Request::post("email");
$newpass = Request::post("pass1");
$newpass2 = Request::post("pass2");

if($newpass === $newpass2){
    $usuario = $userManager->get($email);
	$usuario->setPass($newpass);
	$userManager->set($usuario);
}
header("Location: ../login.php");
exit();