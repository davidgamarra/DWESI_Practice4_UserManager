<?php

require '../classes/AutoLoad.php';
$db = new DataBase();
$userManager = new ManageUser($db);
$sesion = new Session();

$email = Request::post("email");
$newemail = Request::post("newemail");
$pass = Request::post("pass");
$alive = Request::post("alive");
$worker = Request::post("worker");
$admin = Request::post("admin");

$newemail = $newemail === null ? $email : $newemail;
$alive = $alive === null ? 0 : 1;
$worker = $worker === null ? 0 : 1;
$admin = $admin === null ? 0 : 1;

$usuario = $userManager->get($email);
$usuario->setEmail($newemail);
$usuario->setAlias(explode("@", $newemail)[0]);
$usuario->setAlive($alive);
$usuario->setWorker($worker);
$usuario->setAdmin($admin);
if($pass !== null){
    $usuario->setPass($pass);
}
$photo = new FileUpload("image");
if($photo->getError() === false){ 
    $usuario->setImage("images/".$usuario->getAlias().".jpg");
    
    $photo->setDestination("../images/");
    $photo->setName($usuario->getAlias());
    echo $photo->upload();
}

$userManager->setEmail($usuario, $email);
$sesion->destroy();
$sesion->sendRedirect("../admin.php");