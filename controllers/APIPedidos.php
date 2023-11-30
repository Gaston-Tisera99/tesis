<?php

namespace Controllers;



class APIPedidos {

    public static function index() {

        
        $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');

            $sql = "CALL sp_ver_grafico_productos()";
            $result = mysqli_query($db, $sql);
            

            $resultados = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $resultados[] = $row;
            }
            
            echo json_encode($resultados);
            
            mysqli_close($db);
            return;
            // Manejar el caso en el que 'id_categoria' no se envía en la solicitud.
            echo "El parámetro 'id_categoria' no se ha enviado en la solicitud.";
        }

        public static function grafico() {
            $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
        
            if (isset($_POST['fecha1']) && isset($_POST['fecha2'])) {
                $fecha1 = $_POST['fecha1'];
                $fecha2 = $_POST['fecha2'];
                $sql = "CALL sp_ver_grafico_fechas('$fecha1', '$fecha2')";
                $result = mysqli_query($db, $sql);
        
                header('Content-Type: application/json');
        
                if ($result) {
                    $resultados = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $resultados[] = $row;
                    }
        
                    echo json_encode(['success' => true, 'data' => $resultados]);
                } else {
                    echo json_encode(['error' => 'Error en la consulta SQL']);
                }

                mysqli_close($db);
                return;
            }
        
            // Envía un JSON de error si no se proporcionan ambas fechas
            echo json_encode(['error' => 'Ambas fechas deben proporcionarse']);
            mysqli_close($db);
        }

    }

    
 
    
