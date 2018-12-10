<?php
    session_start();
	$pagina = isset($_GET['op']) ? strtolower($_GET['op']) : 'bienvenida';
	echo "<html><body background='imagenes/fondoll.jpg' ><center>";
	echo "<image src='imagenes/logo.png' width='20%'>";
	echo "<br>";
	if($pagina == "restaurantes" || $pagina == "platillosc"){
	    require_once 'paginas/opcionesc.php';
	    echo "<br>";
	} else if($pagina == "platillosr" || $pagina == "rplatillo" || $pagina == "ventas" || $pagina == "pedidos"){
	    require_once 'paginas/opcionesr.php';
	    echo "<br>";
	}
	require_once 'paginas/'.$pagina.'.php';
	echo "<br>";
	require_once 'paginas/pie.php';
	echo "</center></body></html>";
?>