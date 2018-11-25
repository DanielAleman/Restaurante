<?php
    $id = 0;
    $r = 1;
    $n = "";
    $u = "";
    $ino = "";
    $ipe = "";
    $iti = "";
    $in = "";
    $c = "";
    $datos = array();
    if(isset($_GET["id"])){
        $id = $_GET["id"];
    }
    if(isset($_POST["btnGua"])){
            if(!empty($_POST['txtNom']) && !empty($_POST['txtIng']) && !empty($_POST['txtCos']) && isset($_FILES['filIma']) && is_numeric($_POST['txtCos']) && $_POST["txtCos"] > 0){
                $tipo = array("image/jpg", "image/jpeg", "image/png");
                $tamano = 16384;    
                $n = htmlspecialchars($_POST["txtNom"]);
                $in = htmlspecialchars($_POST["txtIng"]);
                $c = htmlspecialchars($_POST["txtCos"]);
                $t = $_FILES['filIma']['tmp_name'];
                if(in_array($_FILES["filIma"]["type"], $tipo) && $_FILES["filIma"]["size"] <= $tamano * 1024){
                    $ino = $_FILES['filIma']['name'];
                    $ipe = (int)$_FILES['filIma']['size'];
                    $iti = $_FILES['filIma']['type'];
                    $u = "../imagenes/".$ino;
                    move_uploaded_file($t, $u);
                    $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
                    $datos = $cliente -> registrarPlatillo($r, $n, $u, $ino, $ipe, $iti, $in, $c);
                    if((int)$datos[0]["CLAVE"] != 0) {
                        echo '<script language="javascript">alert("Datos registrados.")</script>';
                    } else {
                        $datos[0] = 0;
                        echo '<script language="javascript">alert("Datos no registrados.")</script>';
                    }
                } else {
                    echo '<script language="javascript">alert("Imagen no valida.")</script>';
                }
            } else {
                echo '<script language="javascript">alert("Datos incorrectos.")</script>';
            }
    } else if (isset($_POST["btnMod"])){
        if(!empty($_POST["txtNom"]) && !empty($_POST["txtIng"]) && !empty($_POST["txtCos"]) && isset($_FILES["filIma"]["name"]) && is_numeric($_POST['txtCos']) && $_POST["txtCos"] > 0){
            $n = htmlspecialchars($_POST["txtNom"]);
            $in = htmlspecialchars($_POST["txtIng"]);
            $c = htmlspecialchars($_POST["txtCos"]);
            $t = $_FILES['filIma']['tmp_name'];
            $i = addslashes(fread(fopen($t, "rb"), filesize($t)));
            $ino = $_FILES['filIma']['name'];
            $ipe = $_FILES['filIma']['size'];
            $iti = $_FILES['filIma']['type'];
            $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
            $datos = $cliente -> modificarPlatillo($id, $n, $i, $ino, $ipe, $iti, $in, $c);
            if((int)$datos[0]["CLAVE"] != 0) {
                echo '<script language="javascript">alert("Datos registrados.")</script>';
            } else {
                $datos[0] = 0;
                echo '<script language="javascript">alert("Datos no registrados.")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Datos incorrectos.")</script>';
        }
    } else if (isset($_POST["btnEli"])){
        $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
        $datos = $cliente -> eliminarPlatillo($id);
        if((int)$datos[0]["CLAVE"] != 0) {
            echo '<script language="javascript">alert("Datos eliminados.")</script>';
        } else {
            $datos[0] = 0;
            echo '<script language="javascript">alert("Datos no eliminados.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood- Registrar platillo</title>
	<link rel="stylesheet" type="text/css" href="../css/formulario.css">
</head>
<body>
<center>
  
      <section class="sectionT">
            <h1 class="h1T">Registrar platillo</h1>
        </section>
<div id="form">
	<div class='fieldset'>
    <legend>Platillos</legend>
		<form method="POST" name="registrar" enctype="multipart/form-data">
			<div class='row'>
				<input type="text" name='txtNom' placeholder="Platillo">
			</div>
			<div class="row">
				<input type="file" name="filIma" class="file">
			</div>
			<div class='row'>
				<input type="text" name='txtIng' placeholder="Ingredientes">
			</div>
			<div class='row'>
				<input type="text" name='txtCos' placeholder="Costo">
			</div>
			<?php
                if($id == 0){
                        echo '<input type="reset" name="btnCan" value="Cancelar">';
                        echo '<input type="submit" name="btnGua" value="Guardar">';
                } else {
                        echo '<input type="submit" name="btnMod" value="Modificar">';
                        echo '<input type="submit" name="btnEli" value="Eliminar">';
                }
            ?>
		</form>
	</div>
</div>
</center>
</body>
</html>