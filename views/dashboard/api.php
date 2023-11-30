<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
        $json = $_POST['json'];
        $productos = json_decode($json, true);

        $cliente = $_POST['cliente'];
        $monto = floatval($_POST['monto']);
        
        //debuguear($monto);
        $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");      

        // Verifica si la conexión es exitosa
        if (!$con) {
            die("La conexión a la base de datos falló: " . mysqli_connect_error());
        }

        if (empty($cliente)) {
            // Cliente no ingresado, puedes manejar esto de diferentes maneras, por ejemplo, establecer un valor predeterminado o mostrar un mensaje de error y no realizar la inserción.
            echo "Error: Debe elegir un cliente válido.";
        } else {

        $sqlPedido = "INSERT INTO pedido(clienteid, fecha, monto, status) VALUES ('$cliente', NOW(), '$monto', '1')";
        $resultPedido = mysqli_query($con, $sqlPedido);
 
        if ($resultPedido) {
            // Obtiene el ID autonumérico generado para este pedido
            $idPedido = mysqli_insert_id($con);
            //debuguear($idPedido);

            foreach($productos as $producto){
                $idProducto = $producto['idProducto'];
                $codigo = $producto['codigo'];
                $nombre = $producto['nombre'];
                $precio = $producto['precio'];
                $cantidad = $producto['cantidad'];
                $total = $producto['total'];
                
                // Sentencia SQL para insertar un registro en la tabla
                $sql = "INSERT INTO detalle_pedido (pedidoid, productoid, precio, cantidad, total, codigo, nombre) VALUES ('$idPedido','$idProducto', '$precio', '$cantidad', '$total','$codigo', '$nombre')";

                // Ejecuta la consulta de inserción
                $result = mysqli_query($con, $sql);

                // Verifica si la inserción fue exitosa
                if ($result) {
                    echo "El presupuesto se ha generado con éxito. ¡Gracias!";
                } else {
                    echo "Error al generar el presupuesto: " . mysqli_error($con);
                }

            }

        }else{
            echo "Error al insertar pedido: " . mysqli_error($con);
        }

    }

}


?>