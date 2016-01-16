<?php
    require_once './classes/Google/autoload.php';
	require_once './classes/class.phpmailer.php';  //las últimas versiones también vienen con autoload
	require './classes/AutoLoad.php';
	
	$sesion = new Session();

    $origen = "firedge8@gmail.com";
	$alias = "David Gamarra";
	$destino = Request::get("email");
	$asunto = "Activation Log In Account";
	$mensaje = "https://correo-davidgamarra.c9users.io/activation.php?email=".$destino."&code=".sha1($destino.Constant::SEED);
	
	$cliente = new Google_Client();
	$cliente->setApplicationName('ProyectoEnviarCorreoDesdeGmail');
	$cliente->setClientId('694463714072-f8rtilvrud2nnirt9dk1l5se1v834heb.apps.googleusercontent.com');
	$cliente->setClientSecret('zqx3GruU3Z4H4ekuMcEDaWiE');
	$cliente->setRedirectUri('https://correo-davidgamarra.c9users.io/oauth/guardar.php');
	$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose'); // para todo: https://mail.google.com/ 
	$cliente->setAccessToken(file_get_contents('oauth/token.conf'));
	echo "Correo enviado correctamente";
	if ($cliente->getAccessToken()) {
		$service = new Google_Service_Gmail($cliente);
		try {
			$mail = new PHPMailer();
			$mail->CharSet = "UTF-8";
			$mail->From = $origen;
			$mail->FromName = $alias;
			$mail->AddAddress($destino);
			$mail->AddReplyTo($origen, $alias);
			$mail->Subject = $asunto;
			$mail->Body = $mensaje;
			$mail->preSend();
			$mime = $mail->getSentMIMEMessage();
			$mime = rtrim(strtr(base64_encode($mime), '+/', '-_'), '=');
			$mensaje = new Google_Service_Gmail_Message();
			$mensaje->setRaw($mime);
			$service->users_messages->send('me', $mensaje);
		} catch (Exception $e) {
			print($e->getMessage());
		}
	}
	$sesion->destroy();
	$sesion->sendRedirect("login.php");
	
?>