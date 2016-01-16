<?php
	require './classes/AutoLoad.php';

	$email = Request::get("email");
	$code = Request::get("code");

	if($code === sha1($email.Constant::SEED)){
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Log In</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
        <form action="php/phppassrec.php" method="post">
    		<br/><br/><br/>
    		<fieldset>
    			<legend>Change password</legend><br/>
    			<h>New password: <input type="password" name="pass1" value=""/></h>
    			<h>Repeat pass: <input type="password" name="pass2" value=""/></h>
    			<input type="hidden" name="email" value="<?php echo $email; ?>"/>
    			<input type="submit" value="Change" id="guardarperfil"/>
    		</fieldset>
    	</form>
	</body>
</html>
<?php
	} else {
	    echo "Failed password recovery";
	}