<?php
namespace Controllers;

use Model\Productos;

class APIProductos{

    public static function apiGrafico(){
        $producto = new Productos;
        if(isset($_POST)){
            $stock = $producto->getStock();
            echo json_encode($stock);
        }
    }

    public static function graficoVendidos(){
        $producto = new Productos;
        if(isset($_POST)){
            $vendidos = $producto->getVendidos();
            echo json_encode($vendidos);
            
        }
    }

    public static function buscarProductos(){
        $db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

        if(isset($_POST)){
            $campo = $_POST['campo'];

            $sql = "SELECT id, codigo, precio, nombre FROM producto WHERE codigo LIKE ? OR nombre LIKE ? ORDER BY codigo ASC";
            $stmt = mysqli_prepare($db, $sql); 
            
            $campoParam =  $campo . "%";

            mysqli_stmt_bind_param($stmt, "ss", $campoParam, $campoParam);

            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            $html = "";

            while ($row = mysqli_fetch_assoc($result)) {
                $html .= "<li onclick=\"mostrar('" .$row['id']."', '". $row['codigo'] . "', '" . $row['nombre'] . "', '" . $row['precio'] . "')\">" . $row['codigo'] . " - " . $row['nombre'] . "</li>";
                
            }
            echo json_encode($html, JSON_UNESCAPED_UNICODE);
        }
    }
    
    public static function buscarCodigo(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['codigo'];
    
            $con = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
        
            // Verificar la conexión
            if (!$con) {
                die("Conexión fallida: " . mysqli_connect_error());
            }
        
            // Escapar el código para evitar inyección SQL
            $codigo = mysqli_real_escape_string($con, $codigo);
        
            // Consulta para verificar si el código está en uso
            $query = "SELECT COUNT(*) AS cantidad FROM producto WHERE codigo = '$codigo'";
            $result = mysqli_query($con, $query);
        
            // Verificar si la consulta fue exitosa
            if ($result) {
                $row = mysqli_fetch_assoc($result); 
                $cantidad = $row['cantidad'];
                
                if ($cantidad > 0) {
                    echo "¡El código está en uso!";
                } else {
                    echo "¡El código está disponible!";
                }
        
                // Cerrar la conexión a la base de datos
                mysqli_close($con);
            
            } else {
                // Manejar errores en la consulta
                echo "Error en la consulta: " . mysqli_error($con);
            }
        }
    }
}

?>