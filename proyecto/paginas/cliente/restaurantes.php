<?php
    $estado = "0";
    $datos = array();
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
    $datos = $cliente -> contarRestaurantes();
    $totalRegistro = $datos[0];
    $totalPaginas = ceil($totalRegistro/$numRegistro);
    $datosPag = $cliente -> mostrarRestaurantes($inicioPag, $numRegistro);
    $estado = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Restaurantes</title>
	<link rel="stylesheet" type="text/css" href="../css/tablas.css">
</head>
<body>
     <section class="sectionT">
            <h1 class="h1T">Restaurantes disponibles en la localidad</h1>
        </section>
	<div class="tabla">
		<?php
            if($estado != 0){
                for($rr = 0; $rr < count($datosPag); $rr++){
                    echo "<ul>";
                        echo "<li>".$datosPag[$rr]["NOMBRE"]."</li>";
                        echo "<li>".$datosPag[$rr]["DIRECCION"]."</li>";
                        echo "<li>Horario:</li>";
                        echo "<li class='o'>Lunes a Viernes: ".$datosPag[$rr]["SEMANA"]."</li>";
                        echo "<li class='o'>Sabado y Domingo: ".$datosPag[$rr]["FIN"]."</li>";
                        echo "<li>".$datosPag[$rr]["DIAS"]."</li>";
                        echo "<li>".$datosPag[$rr]["PAGO"]."</li>";
                        echo "<li><a href='?op=platillos&idr=".$datosPag[$rr]["CLAVE"]."'>Ver</a></li>";
                    echo "</ul>";
                }
                if($totalPaginas > 1){
                    echo "<label>Paginas: </label>";
                } else {
                    echo "<label>Pagina: </label>";
                }
                for($i = 1; $i < $totalPaginas; $i++){
                    if($numPagina == $i){
                        echo "<label>$numPagina</label>";
                    } else {
                        echo "<a href='?op=restaurantes&pagina = $i'>$i</a>";
                    }
                }
            }
        ?>
	</div>
</body>
</html>