<?php
    $idr = 1;
    if(isset($_GET["idr"])){
        $idr = $_GET["idr"];
    }
    $estado = "0";
    $datos = array();
    $totalRegistro =0;
    $numRegistro = 10;
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
    $datos = $cliente -> contarPlatillos($idr);
    $totalRegistro = $datos[0];
    $totalPaginas = ceil($totalRegistro/$numRegistro);
    $datosPag = $cliente -> mostrarPlatillos($inicioPag, $numRegistro, $idr);
    $estado = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Platillos</title>
	<link rel="stylesheet" type="text/css" href="css/tabladatoss.css">
</head>
<body>
    <center>
        
         <section class="sectionT">
            <h1 class="h1T">Platillos registrados</h1>
        </section>
	<table class="tabla">
		<thead>
			<tr>
				<th class="p">ID</th>
				<th>PLATILLO</th>
				<th class="o">IMAGEN</th>
				<th class="o">INGREDIENTES</th>
				<th>COSTO</th>
				<th>ACCIONES</th>
			</tr>
		</thead>
		<tbody>
			<?php
                if($estado != 0){
                    for($rr = 0; $rr < count($datosPag); $rr++){
                        echo "<tr>";
                            echo "<td class='p'>".$datosPag[$rr]["CLAVE"]."</td>";
                            echo "<td>".$datosPag[$rr]["NOMBRE"]."</td>";
                            echo "<td class='o'><img src='imagenes/".$datosPag[$rr]["IMAGEN"]."' width='34%'></td>";
                            echo "<td class='o'>".$datosPag[$rr]["INGREDIENTES"]."</td>";
                            echo "<td>".$datosPag[$rr]["COSTO"]."</td>";
                            echo "<td><a href='?op=rplatillo&id=".$datosPag[$rr]["CLAVE"]."'>Ver</a></td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table><br>";
                    if($totalPaginas > 1){
                        echo "<label>Paginas: </label>";
                    } else {
                        echo "<label>Pagina: </label>";
                    }
                    for($i = 1; $i < $totalPaginas; $i++){
                        if($numPagina == $i){
                            echo "<label>$numPagina</label>";
                        } else {
                            echo "<a href='?op=platillosr&pagina = $i'>$i</a>";
                        }
                    }
                }
            ?>
	</center>
</body>
</html>