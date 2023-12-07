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
        $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');

        if(isset($_POST)){
            $campo = $_POST['campo'];

            $sql = "SELECT id, codigo, precio, nombre FROM producto WHERE codigo LIKE ? OR nombre LIKE ? ORDER BY codigo ASC";
            $stmt = mysqli_prepare($db, $sql); 

            $campoParam = "%" . $campo . "%";

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
}

?>