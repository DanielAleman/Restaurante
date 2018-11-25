<?php
	$pagina = isset($_GET['op']) ? strtolower($_GET['op']) : 'bienvenida';
	echo "<html><body background='imagenes/fondoll.jpg' ><center>";
	echo "<image src='imagenes/logo.png' width='20%'>";
	echo "<br>";
	require_once $pagina.'.php';
	echo "<br>";
	require_once 'paginas/pie.php';
	echo "</center></body></html>";
?>