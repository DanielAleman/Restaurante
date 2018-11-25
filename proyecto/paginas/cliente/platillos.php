<?php
    $estado = "0";
    $datos= array();
    $totalRegistro =0;
    $numRegistro = 5;
    $cliente = new SoapClient(null, array('uri' => 'http://localhost/', 'location' => 'https://upmhbilly.000webhostapp.com/proyecto/servicioweb/servicio.php'));
    if(isset($_GET['pagina'])){
        $numPagina = $_GET['pagina'];
    } else {
        $inicioPag = 0;
        $numPagina = 1;
    }
    if($numPagina > 1){
        $inicioPag = ($numPagina - 1) * $numRegistro;
    } else {
        $inicioPag = 0;
    }
    $datos = $cliente -> contarPlatillos();
    $totalRegistro = $datos[0];
    $totalPaginas = ceil($totalRegistro/$numRegistro);
    $datosPag = $cliente -> mostrarPlatillos($inicioPag, $numRegistro);
    $estado = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Platillos</title>
	<link rel="stylesheet" type="text/css" href="../css/tablas.css">
</head>
<body>
    <center>
        
         <section class="sectionT">
            <h1 class="h1T">Platillos disponibles</h1>
        </section>
    </center>
	<div class="tabla">
	    <?php
            if($estado != 0){
                for($rr = 0; $rr < count($datosPag); $rr++){
                    echo "<ul>";
                        echo "<li><img src='../imagenes/".$datosPag[$rr]["IMAGEN"]."' width='100%'>";
                        echo "<li>".$datosPag[$rr]["NOMBRE"]."</li>";
                        echo "<li>".$datosPag[$rr]["INGREDIENTES"]."</li>";
                        echo "<li>Costo: $".$datosPag[$rr]["COSTO"]."</li>";
                        echo "<li><input type='text' name='txtUbi' placeholder='Ubicación'></li>";
                        echo "<li><a href='?op=compra&id=".$datosPag[$rr]["CLAVE"]."'>Comprar</a></li>";
                    echo "</ul>";
                }
                echo "</div><div>";
                if($totalPaginas > 1){
                    echo "<label>Paginas: </label>";
                } else {
                    echo "<label>Pagina: </label>";
                }
                for($i = 1; $i < $totalPaginas; $i++){
                    if($numPagina == $i){
                        echo "<label>$numPagina</label>";
                    } else {
                        echo "<a href='?op=platillos&pagina = $i'>$i</a></div>";
                    }
                }
            }
        ?>
	</div>
</body>
</html>