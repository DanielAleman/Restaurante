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
    $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $datos = $cliente -> consultarPlatillo($id);
        $n = $datos[0]["NOMBRE"];
        $in = $datos[1]["INGREDIENTES"];
        $c = $datos[2]["COSTO"];
        $imagen = $datos[3]["IMAGEN"];
    }
    if(isset($_POST["btnGua"])){
        if(!empty($_POST["txtNom"]) && !empty($_POST["txtIng"]) && !empty($_POST["txtCos"]) && isset($_FILES["filIma"]["name"]) && is_numeric($_POST['txtCos']) && $_POST["txtCos"] > 0){
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
                $u = "imagenes/".$ino;
                move_uploaded_file($t, $u);
                $datos = $cliente -> registrarPlatillo($r, $n, $u, $ino, $ipe, $iti, $in, $c);
                echo '<script language="javascript">alert("Datos registrados.");document.location.href="?op=platillosr";</script>';
            } else {
                echo '<script language="javascript">alert("Imagen no valida.")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Datos incorrectos.")</script>';
        }
    } else if (isset($_POST["btnMod"])){
        if(!empty($_POST["txtNom"]) && !empty($_POST["txtIng"]) && !empty($_POST["txtCos"]) && isset($_FILES["filIma"]["name"]) && is_numeric($_POST['txtCos']) && $_POST["txtCos"] > 0){
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
                $u = "imagenes/".$ino;
                move_uploaded_file($t, $u);
                $datos = $cliente -> modificarPlatillo($id, $r, $n, $u, $ino, $ipe, $iti, $in, $c);
                echo '<script language="javascript">alert("Datos registrados.");document.location.href="?op=platillosr";</script>';
            } else {
                echo '<script language="javascript">alert("Imagen no valida.")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Datos incorrectos.")</script>';
        }
    } else if (isset($_POST["btnEli"])){
        $datos = $cliente -> eliminarPlatillo($id);
        if((int)$datos[0]["CLAVE"] != 0) {
            echo '<script language="javascript">alert("Datos eliminados.");document.location.href="?op=platillosr";</script>';
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
	<link rel="stylesheet" type="text/css" href="css/formulario.css">
</head>
<body>
    <section class="sectionT">
        <h1 class="h1T">Registrar platillo</h1>
    </section>
    <div id="form">
        <div class='fieldset'>
            <legend>Platillos</legend>
            <form method="POST" name="registrar" enctype="multipart/form-data">
                <div class='row'>
                    <input type="text" name='txtNom' placeholder="Platillo" value="<?php echo $n;?>">
                </div>
                <?php
                    if($id != 0){
                        echo '<img src="imagenes/'.$imagen.'" width="100%"><br><br>';
                    }
                ?>
                <div class="row">
                    <input type="file" name="filIma" class="file">
                </div>
                <div class='row'>
                    <input type="text" name='txtIng' placeholder="Ingredientes" value="<?php echo $in;?>">
                </div>
                <div class='row'>
                    <input type="text" name='txtCos' placeholder="Costo" value="<?php echo $c;?>">
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
</body>
</html>