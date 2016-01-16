<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);
$sesion = new Session();

$email = Request::post("email");

$usuario = $userManager->get($sesion->getUser());
$oldmail = $usuario->getEmail();
$usuario->setEmail($email);
$usuario->setAlias(explode("@", $email)[0]);
$usuario->setAlive(0);

$userManager->setEmail($usuario, $oldmail);
$sesion->destroy();
$sesion->sendRedirect("../emailactivation.php?email=".$email);