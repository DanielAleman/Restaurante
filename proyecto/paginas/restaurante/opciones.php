<!DOCTYPE html>
<html>
<head>
    <meta name=viewport content="witdh=device-witdh, initial-scale=1, maximum-scale=1, height=device-height, user-scale=true">
		<link rel="stylesheet" type="text/css" href="../css/opcion.css">
		<link rel="stylesheet" type="text/css" href="../css/fonts.css">
</head>
<body>

	<center><img src="../imagenes/logo.png" width="20%"></center>
	
	
		
	<header>
	<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-menu"></span>Menu</a>
		</div>
	
	<nav>
		<ul>
			<li><a href="?op=platillos"><span>Platillos</span></a></li>
			<li><a href="?op=rplatillo"><span>Registrar</span></a></li>
			<li><a href="?op=pedidos"><span>Pedidos</span></a></li>
			<li><a href="?op=ventas"><span>Ventas</span></a></li>
			<li><a href="../inicio.php"><span>Cerrar sesion</span></a></li>
		</ul>
	</nav>
	</header>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script >
$(document).ready(main);
 
var contador = 1;
 
function main(){
	$('.menu_bar').click(function(){
		// $('nav').toggle(); 
 
		if(contador == 1){
			$('nav').animate({
				left: '0'
			});
			contador = 0;
		} else {
			contador = 1;
			$('nav').animate({
				left: '-100%'
			});
		}
 
	});
 
};</script>
</body>
</html>