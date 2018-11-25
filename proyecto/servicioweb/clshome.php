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
        public function contarPlatillos(){
            $res = array();
            if($conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spMostrarPlatillos(0, 0, 0)");
                $res[0] = mysqli_num_rows($consulta);
            }
            mysqli_free_result($consulta);
            mysqli_close($conn);
            return $res;
        }
        public function mostrarPlatillos($inicioPag, $numRegistro){
            $res = array();
            $reg = 0;
            $conn = mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios");
            $recordSet = mysqli_query($conn, "CALL spMostrarPlatillos('$inicioPag', '$numRegistro', 1)");
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
        public function modificarPlatillo($id, $n, $i, $ino, $ipe, $iti, $in, $c){
         $datos = array();
            if($conn= mysqli_connect("localhost", "id7082144_billy", "qwerty", "id7082144_bdejercicios")){
                $consulta = mysqli_query($conn, "CALL spModificarPlatillo('$id', '$i', '$ino', '$ipe', '$iti', '$in', '$c')");
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
    }
?>