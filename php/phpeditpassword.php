<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);
$sesion = new Session();

$oldpass = Request::post("pass");
$newpass = Request::post("newpass");
$newpass2 = Request::post("newpass2");

$usuario = $userManager->get($sesion->getUser());

if($usuario->getPass() === sha1($oldpass) && $newpass === $newpass2){
	$usuario->setPass($newpass);
}

$userManager->set($usuario);
$sesion->sendRedirect("../index.php");