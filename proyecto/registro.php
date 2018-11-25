<?php
    $n = "";
    $a = "";
    $t = "";
    $u = "";
    $c1 = "";
    $c2 = "";
    $datos = array();
    if(!empty($_POST["txtNom"]) && !empty($_POST["txtApe"]) && !empty($_POST["txtTel"]) && !empty($_POST["txtUsu"]) && !empty($_POST["txtCon1"]) && !empty($_POST["txtCon2"])){
        $n = ($_POST["txtNom"]);
        $a = ($_POST["txtApe"]);
        $t = ($_POST["txtTel"]);
        $u = ($_POST["txtUsu"]);
        $c1 = ($_POST["txtCon1"]);
        $c2 = ($_POST["txtCon2"]);
	    if($c1 == $c2){
            $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
            $datos = $cliente -> registrarUsuario($n, $a, $t, $u, $c1);
            if((int)$datos[0]["CLAVE"] != 0) {
                echo '<script language="javascript">alert("Datos registrados.")</script>';
            } else {
                $datos[0] = 0;
                echo '<script language="javascript">alert("Datos no registrados.")</script>';
            }
	    } else {
    	    echo '<script language="javascript">alert("Contrasenas no coinciden.")</script>';
	    }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Registro</title>
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
</head>
<body >
<center>
<div id="form">
	<div class='fieldset'>
    <legend>Registro de usuario</legend>
		<form method="POST" name="registrar">
			<div class='row'>
				<input type="text" name='txtNom' placeholder="Nombre(s)">
			</div>
			<div class='row'>
				<input type="text" name='txtApe' placeholder="Apellidos">
			</div>
			<div class='row'>
				<input type="number" name='txtTel' placeholder="Telefono">
			</div>
			<div class='row'>
				<input type="text" name='txtUsu' placeholder="Usuario">
			</div>
			<div class='row'>
				<input type="password" name='txtCon1' placeholder="Contrasena">
			</div>
			<div class='row'>
				<input type="password" name='txtCon2' placeholder="Repita contrasena">
			</div>
			<input type="reset" name="btnCan" value="Cancelar">
			<input type="submit" name="btnAce" value="Aceptar">
			<br><br><br><a href="?op=login">Regresar</a>
		</form>
	</div>
</div>
</center>
</body>
</html>