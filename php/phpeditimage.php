<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);
$sesion = new Session();

$usuario = $userManager->get($sesion->getUser());
$usuario->setImage("images/".$usuario->getAlias().".jpg");

$photo = new FileUpload("image");
$photo->setDestination("../images/");
$photo->setName($usuario->getAlias());
echo $photo->upload();

$userManager->set($usuario);
$sesion->sendRedirect("../index.php");