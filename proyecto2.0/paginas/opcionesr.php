<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/opcion.css">
        <link rel="stylesheet" type="text/css" href="css/fonts.css">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    </head>
    <body >
        <header>
            <div class="menu_bar">
                <a href="#" class="bt-menu"><span class="icon-menu"></span>Menu</a>
            </div>
            <nav>
                <ul>
                    <li><a href="?op=platillosr"><span>Platillos</span></a></li>
                    <li><a href="?op=rplatillo"><span>Registrar</span></a></li>
                    <li><a href="?op=pedidos"><span>Pedidos</span></a></li>
                    <li><a href="inicio.php"><span>Cerrar sesi&oacuten</span></a></li>
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
            };
        </script>
    </body>
</html>