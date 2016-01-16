<?php
	require './classes/AutoLoad.php';

	$email = Request::get("email");
	$code = Request::get("code");

	if($code === sha1($email.Constant::SEED)){
    	$db = new DataBase();
        $userManager = new ManageUser($db);
    
        $usuario = $userManager->get($email);
        $usuario->setAlive(1);
    
        $userManager->set($usuario);
        echo "Account activated!!";
	} else {
	    echo "Failed activation";
	}