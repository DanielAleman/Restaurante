<?php
    class clshome{
        public function acceso($usuario, $contra){
            $datos = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $renglon = mysqli_query($conn, "CALL spAcceso('$usuario', '$contra')");
                while($resultado = mysqli_fetch_assoc($renglon)){
                    $datos[0]["CLAVE"] = $resultado["CLAVE"];
                    if((int)$datos[0] != 0){
                        $datos[1]["NOMBRE"] = $resultado["NOMBRE"];
                        $datos[2]["RESTAURANTE"] = $resultado["RESTAURANTE"];
                    }
                }
            }
            mysqli_close($conn);
            return $datos;
        }
        public function registrarUsuario($n, $a, $t, $u, $c1){
            $datos = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spRegistrarUsuario('$n', '$a', '$t', '$u', '$c1')");
                while($resultado = mysqli_fetch_assoc($consulta)){
                    $datos[0]["CLAVE"] = $resultado["CLAVE"];
                }
            }
            mysqli_close($conn);
            return $datos;
        }
        public function registrarPlatillo($r, $n, $u, $ino, $ipe, $iti, $in, $c){
            $datos = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spRegistrarPlatillo('$r', '$n', '$u', '$ino', '$ipe', '$iti', '$in', '$c')");
                while($resultado = mysqli_fetch_assoc($consulta)){
                    $datos[0]["CLAVE"] = $resultado["CLAVE"];
                }
            }
            mysqli_close($conn);
            return $datos;
        }
        public function eliminarPlatillo($id){
            $datos = array();
            if($conn= mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spEliminarPlatillo('$id')");
                while($resultado = mysqli_fetch_assoc($consulta)){
                    $datos[0]["CLAVE"] = $resultado["CLAVE"];
                }
            }
            mysqli_close($conn);
            return $datos;
        }
        public function contarPlatillos($idr){
            $res = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spMostrarPlatillos(0, 0, '$idr', 0)");
                $res[0] = mysqli_num_rows($consulta);
            }
            mysqli_free_result($consulta);
            mysqli_close($conn);
            return $res;
        }
        public function mostrarPlatillos($inicioPag, $numRegistro, $idr){
            $res = array();
            $reg = 0;
            $conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios");
            $recordSet = mysqli_query($conn, "CALL spMostrarPlatillos('$inicioPag', '$numRegistro', '$idr', 1)");
            while($resultado = mysqli_fetch_assoc($recordSet)){
                $res[$reg]["CLAVE"] = $resultado["CLAVE"];
                $res[$reg]["NOMBRE"] = $resultado["NOMBRE"];
                $res[$reg]["IMAGEN"] = $resultado["IMAGEN"];
                $res[$reg]["INGREDIENTES"] = $resultado["INGREDIENTES"];
                $res[$reg]["COSTO"] = $resultado["COSTO"];
                $reg++;
            }
            mysqli_free_result($recordSet);
            mysqli_close($conn);
            return $res;
        }
        public function modificarPlatillo($id, $r, $n, $u, $ino, $ipe, $iti, $in, $c){
         $datos = array();
            if($conn= mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spModificarPlatillo('$id', '$r', '$n', '$u', '$ino', '$ipe', '$iti', '$in', '$c')");
                while($resultado = mysqli_fetch_assoc($consulta)){
                    $datos[0]["CLAVE"] = $resultado["CLAVE"];
                }
            }
            mysqli_close($conn);
            return $datos;
        }
        public function contarRestaurantes(){
            $res = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spMostrarRestaurantes(0, 0, 0)");
                $res[0] = mysqli_num_rows($consulta);
            }
            mysqli_free_result($consulta);
            mysqli_close($conn);
            return $res;
        }
        public function  mostrarRestaurantes($inicioPag, $numRegistro){
            $res = array();
            $reg = 0;
            $conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios");
            $recordSet = mysqli_query($conn, "CALL spMostrarRestaurantes('$inicioPag', '$numRegistro', 1)");
            while($resultado = mysqli_fetch_assoc($recordSet)){
                $res[$reg]["CLAVE"] = $resultado["CLAVE"];
                $res[$reg]["NOMBRE"] = $resultado["NOMBRE"];
                $res[$reg]["DIRECCION"] = $resultado["DIRECCION"];
                $res[$reg]["SEMANA"] = $resultado["SEMANA"];
                $res[$reg]["FIN"] = $resultado["FIN"];
                $res[$reg]["DIAS"] = $resultado["DIAS"];
                $res[$reg]["PAGO"] = $resultado["PAGO"];
                $reg++;
            }
            mysqli_free_result($recordSet);
            mysqli_close($conn);
            return $res;
        }
        public function consultarPlatillo($id){
            $datos = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spConsultarPlatillo('$id')");
                while($resultado = mysqli_fetch_assoc($consulta)){
                    $datos[0]["NOMBRE"] = $resultado["NOMBRE"];
                    $datos[1]["INGREDIENTES"] = $resultado["INGREDIENTES"];
                    $datos[2]["COSTO"] = $resultado["COSTO"];
                    $datos[3]["IMAGEN"] = $resultado["IMAGEN"];
                }
            }
            mysqli_free_result($consulta);
            mysqli_close($conn);
            return $datos;
        }
        public function registrarPedido($ima, $nom, $cos, $ubi, $idu){
            $datos = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spRegistrarPedido('$ima', '$nom', '$cos', '$ubi', '$idu')");
                while($resultado = mysqli_fetch_assoc($consulta)){
                    $datos[0]["CLAVE"] = $resultado["CLAVE"];
                }
            }
            mysqli_close($conn);
            return $datos;
        }
        public function contarPedidos(){
            $res = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spMostrarPedidos(0, 0, 0)");
                $res[0] = mysqli_num_rows($consulta);
            }
            mysqli_free_result($consulta);
            mysqli_close($conn);
            return $res;
        }
        public function mostrarPedidos($inicioPag, $numRegistro){
            $res = array();
            $reg = 0;
            $conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios");
            $recordSet = mysqli_query($conn, "CALL spMostrarPedidos('$inicioPag', '$numRegistro', 1)");
            while($resultado = mysqli_fetch_assoc($recordSet)){
                $res[$reg]["CLAVE"] = $resultado["CLAVE"];
                $res[$reg]["IMAGEN"] = $resultado["IMAGEN"];
                $res[$reg]["PLATILLO"] = $resultado["PLATILLO"];
                $res[$reg]["COSTO"] = $resultado["COSTO"];
                $res[$reg]["DIRECCION"] = $resultado["DIRECCION"];
                $res[$reg]["CLIENTE"] = $resultado["CLIENTE"];
                $res[$reg]["FECHA"] = $resultado["FECHA"];
                $reg++;
            }
            mysqli_free_result($recordSet);
            mysqli_close($conn);
            return $res;
        }
    }
?>