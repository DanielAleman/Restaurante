<?php
    include 'clshome.php';
	$soap = new SoapServer(null, array('uri' => 'http://localhost/'));
	$soap -> setClass('clshome');
	$soap -> handle();
?>