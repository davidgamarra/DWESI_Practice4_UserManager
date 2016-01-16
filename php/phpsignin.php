<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);
$sesion = new Session();

$email = Request::post("email");
$pass1 = Request::post("psw1");
$pass2 = Request::post("psw2");

$disponible = $userManager->get($email);

if($pass1 === $pass2 && $disponible->getEmail() === null){
	$usuario = new User($email, $pass1, explode("@", $email)[0], date('Y-m-d G:i:s'), "images/no_image.jpg", 0, 0, 0);
	$userManager->insert($usuario);
	
	$sesion->setUser($email);
	$sesion->sendRedirect("../emailactivation.php?email=".$email);
} else {
	$sesion->sendRedirect("../login.php");	
}
