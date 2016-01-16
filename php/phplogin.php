<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);

$user = Request::post("user");
$pass = Request::post("psw");

$usuario = $userManager->get($user);
$sesion = new Session();

if($usuario !== null && $usuario->getPass() === sha1($pass)){
	$sesion->setUser($user);
	$sesion->sendRedirect("../index.php");
} else {
	$sesion->destroy();
	$sesion->sendRedirect("../login.php");
}