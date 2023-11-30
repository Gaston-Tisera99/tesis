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
}

?>