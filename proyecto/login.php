<?php
    $usuario = "";
	$contra = "";
	$datos = array();
	if(isset($_POST["btnAce"])){
        if(!empty($_POST["txtUsu"]) && !empty($_POST["txtCon"])){
            $usuario = htmlspecialchars($_POST["txtUsu"]);
            $contra = htmlspecialchars($_POST["txtCon"]);
            $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
            $datos =  $cliente -> acceso($usuario, $contra);
            if((int)$datos[0]["CLAVE"] != 0){
                if((int)$datos[2]["RESTAURANTE"] != 0){
                    echo '<script language="javascript">alert("Bienvenido al sistema '.$datos[1]["NOMBRE"].'.");document.location.href="paginas/inicio-restaurante.php";</script>';
                } else {
                    echo '<script language="javascript">alert("Bienvenido al sistema '.$datos[1]["NOMBRE"].'.");document.location.href="paginas/inicio-cliente.php";</script>';
                }
            } else {
                $datos[0] = 0;
                echo '<script language="javascript">alert("Usuario no registrado.")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Debe llenar los campos.")</script>';
        }
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Inicio</title>
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
</head>
<body >
<div id="form">
	<div class='fieldset'>
    <legend>Inicio de sesion</legend>
		<form method="POST" name="registrar">
			<div class='row'>
				<input type="text" name="txtUsu" placeholder="Usuario">
			</div>
			<div class='row'>
				<input type="password" name="txtCon" placeholder="Contrasena">
			</div>
			<input type="button" name="btnCan" value="Cancelar" onclick="location.href='?op=bienvenida'">
			<input type="submit" name="btnAce" value="Aceptar">
			<br><br><br>
			<div class="row">
				¿No tienes una cuenta?&nbsp;<a class="a" href="?op=registro">Registrate aqui.</a>
			</div>
		</form>
	</div>
</div>
<article>PRUEBA PAL MOY</article>
</body>
</html>