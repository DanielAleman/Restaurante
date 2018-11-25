<?php
    $pagina = isset($_GET['op'])? strtolower ($_GET['op']) : 'restaurantes';
    echo "<html><center><body background='../imagenes/fondoll.jpg' ></center>";
    require_once 'cliente/opciones.php';
    echo "<br><br><center>";
    require_once 'cliente/'.$pagina.'.php';
    echo "<br><br><br>";
    require_once 'pie.php';
    echo "</center></body></html>";
?>