<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);
$sesion = new Session();

$email = Request::post("email");
$confirm = Request::post("confirm");

if($confirm === "yes"){
	$userManager->delete($email);
	
	$sesion->setUser($email);
}
$sesion->sendRedirect("../admin.php");