<?php
    $t = 0;
    $estado = "0";
    $datos= array();
    $totalRegistro =0;
    $numRegistro = 15;
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
    $datos = $cliente -> contarPedidos();
    $totalRegistro = $datos[0];
    $totalPaginas = ceil($totalRegistro/$numRegistro);
    $datosPag = $cliente -> mostrarPedidos($inicioPag, $numRegistro);
    $estado = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
	<title>HomeFood - Pedidos</title>
	<link rel="stylesheet" type="text/css" href="css/tabladatoss.css">
</head>
<body>
    <center>
        <section class="sectionT">
            <h1 class="h1T">Ordenes de platillos</h1>
        </section>
	<table class="tabla">
		<thead>
			<tr>
				<th class="o">ID</th>
				<th class="o">IMAGEN</th>
				<th>PLATILLO</th>
				<th class='o'>CLIENTE</th>
				<th>DIRECCI&OacuteN</th>
				<th class="o">FECHA</th>
				<th>COSTO</th>
			</tr>
		</thead>
		<tbody>
			<?php
                if($estado != 0){
                    for($rr = 0; $rr < count($datosPag); $rr++){
                        echo "<tr>";
                            echo "<td class='o'>".$datosPag[$rr]["CLAVE"]."</td>";
                            echo "<td class='o'><img src='imagenes/".$datosPag[$rr]["IMAGEN"]."' width='50%'></td>";
                            echo "<td>".$datosPag[$rr]["PLATILLO"]."</td>";
                            echo "<td class='o'>".$datosPag[$rr]["CLIENTE"]."</td>";
                            echo "<td>".$datosPag[$rr]["DIRECCION"]."</td>";
                            echo "<td class='o'>".$datosPag[$rr]["FECHA"]."</td>";
                            echo "<td>".$datosPag[$rr]["COSTO"]."</td>";
                        echo "</tr>";
                        $t += $datosPag[$rr]["COSTO"];
                    }
                    echo "<tr>";
                        echo "<td class='o' colspan='6' align='right'>TOTAL</td>";
                        echo "<td>".$t."</td>";
                    echo "</tr>";
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