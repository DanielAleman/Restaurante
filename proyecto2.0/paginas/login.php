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
                    echo '<script language="javascript">alert("Bienvenido al sistema '.$datos[1]["NOMBRE"].'.");document.location.href="?op=platillosr";</script>';
                } else {
                    if(!isset($_SESSION["cveUsu"])){
                        $_SESSION["cveUsu"] = $datos[0]["CLAVE"];
                    }
                    echo '<script language="javascript">alert("Bienvenido al sistema '.$datos[1]["NOMBRE"].'.");document.location.href="?op=restaurantes";</script>';
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body >
    <div id="form">
        <div class='fieldset'>
            <legend>Inicio de sesi&oacuten</legend>
            <form method="POST" name="registrar">
                <div class='row'>
                    <input type="text" name="txtUsu" placeholder="Usuario">
                </div>
                <div class='row'>
                    <input type="password" name="txtCon" placeholder="Contraseña">
                </div>
                <input type="reset" name="btnCan" value="Cancelar" onclick="location.href='?op=bienvenida'">
                <input type="submit" name="btnAce" value="Aceptar">
                <br><br><br>
                <div class="row">
                    ¿No tienes una cuenta?&nbsp;<a class="a" href="?op=registro">Reg&iacutestrate aqu&iacute.</a>
                </div>
                
            </form>
        </div>
    </div>
    
    <div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="true"></div>
    
<div id="fb-root"></div><br>


<script>
  
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
 
    if (response.status === 'connected') {
   
      testAPI();
    } else {
      
      document.getElementById('status').innerHTML = 'Inicia ' +
        'en esta app.';
    }
  }

  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{292613938040544}',
      cookie     : true,  
                          
      xfbml      : true,  
      version    : 'v2.8' 
    });

    

    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });

  };

 
  
  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v3.2&appId=292613938040544&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


  function testAPI() {
    console.log(':DDDDD.... ');
    FB.api('/me', function(response) {
      console.log('Hola!!!!!!!: ' + response.name);
      document.getElementById('status').innerHTML =
        'Gracias por logearte, ' + response.name + '!';
        document.location.href="inicio.php?op=restaurantes";
    });
  }
</script>



<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button>

<div id="status">
</div>
     
</body>
</html>