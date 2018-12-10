<?php
    $pla = 0;
    $ima = "";
    $nom = "";
    $ing = "";
    $cos = "";
    $ubi = "";
    $datosPla = array();
    $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
    $datos = array();
    if(isset($_GET["pla"])){
        $pla = $_GET["pla"];
        $datos = $cliente -> consultarPlatillo($pla);
        $ima = $datos[3]["IMAGEN"];
        $nom = $datos[0]["NOMBRE"];
        $ing = $datos[1]["INGREDIENTES"];
        $cos = $datos[2]["COSTO"];
    }
    if(isset($_POST["btnCom"])){
        if(!empty($_POST["txtUbi"])){
            $ubi = htmlspecialchars($_POST["txtUbi"]);
            $datosPla = $cliente -> registrarPedido($ima, $nom, $cos, $ubi, $_SESSION["cveUsu"]);
            if((int)$datosPla[0]["CLAVE"] != 0) {
                echo '<script language="javascript">alert("Compra realizada.")</script>';
            } else {
                $datosPla[0] = 0;
                echo '<script language="javascript">alert("Compra no realizada.")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Debe llenar el campo de direccion.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Comprar</title>
	<link rel="stylesheet" type="text/css" href="css/tabladatoss.css">
</head>
<body>
    <center>
        <section class="sectionT">
            <h1 class="h1T">Comprar platillo</h1>
        </section>
        <form name="comprar" method="POST">
                <table class="tabla" width="50%">
                    <tbody>
                        <tr><td colspan="2"><img src="imagenes/<?php echo $ima;?>" width="100%"></td></tr>
                        <tr><td colspan="2"><?php echo $nom;?></td></tr>
                        <tr>
                            <td>Ingredientes:</td>
                            <td><?php echo $ing;?></td>
                        </tr>
                        <tr>
                            <td>Costo:</td>
                            <td><?php echo $cos;?></td>
                        </tr>
                        <tr>
                            <td>Ingrese su ubicaci&oacuten</td>
                            <td><input type"text" name="txtUbi" class="abc"></td>
                        </tr>
                        <tr>
                            <td><input type="button" name="btnCan" value="Regresar" onclick="location.href='?op=platillosc'"></td>
                            <td><input type="submit" name="btnCom" value="Comprar"></td>
                        </tr>
                    </tbody>
                </table>
        </form>
    </center>
</body>
</html>