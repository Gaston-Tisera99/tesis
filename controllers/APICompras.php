<?php

namespace Controllers;

use Model\Productos;

class APICompras{
    
    public static function buscar(){
        $producto = new Productos;
        if(isset($_POST)){
            $id = $_POST['id'];
            $resultado = $producto->buscarProducto($id);
            if ($resultado) {
                // Convierte el resultado a JSON y envía como respuesta
                $result = $resultado->fetch_assoc();
                echo json_encode($result);
            } else {
                // Si no se encontró un producto, envía una respuesta de error
                http_response_code(404);
                echo json_encode(array('error' => 'Producto no encontrado'));
            }
            
        }
        
    }

    public static function nombre(){
        $producto = new Productos;
        if(isset($_POST)){
            $nombre = $_POST['nombre'];
            $resultado = $producto->buscarNombre($nombre);
            if ($resultado) {
                // Convierte el resultado a JSON y envía como respuesta
                $result = $resultado->fetch_assoc();
                echo json_encode($result);
            } else {
                // Si no se encontró un producto, envía una respuesta de error
                http_response_code(404);
                echo json_encode(array('error' => 'Producto no encontrado'));
            }
            
        }
        
    }

    public static function guardar(){
        if(isset($_POST)){
            $json = $_POST['json'];
            $productos = json_decode($json, true);
            $monto = floatval($_POST['monto']);
            $proveedor = $_POST['proveedor'];
            

            $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");

            if (!$con) {
                die("La conexión a la base de datos falló: " . mysqli_connect_error());
            }

            $sqlCompra = "INSERT INTO compra(fecha, monto, status, proveedorId) VALUES (NOW(), '$monto', '1', '$proveedor')";
            $resultCompra = mysqli_query($con, $sqlCompra);

            if ($resultCompra) {
                // Obtiene el ID autonumérico generado para este pedido
                $idCompra = mysqli_insert_id($con);
                foreach($productos as $producto){
                    $idProducto = $producto['idProducto'];
                    $codigo = $producto['codigo'];
                    $nombre = $producto['nombre'];
                    $precio = $producto['precio'];
                    $cantidad = $producto['cantidad'];
                    $total = $producto['total'];
                
                    $sql = "INSERT INTO detalle_compra (compraid, productoid, precio, cantidad, total, codigo, nombre) VALUES ('$idCompra','$idProducto', '$precio', '$cantidad', '$total','$codigo', '$nombre')";

                    $result = mysqli_query($con, $sql);

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

    public static function confirmar(){
        $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");
        
        if(isset($_POST['id'])){
            $id = $_POST['id'];
    
            $query = "UPDATE pedido SET STATUS = 2 WHERE idpedido = $id";
            $resultado = mysqli_query($con, $query);
    
            if($resultado){
                $sql = "SELECT cantidad, codigo FROM detalle_pedido WHERE pedidoid = $id";
                $result = mysqli_query($con, $sql);
    
                $success = true;
    
                while ($row = mysqli_fetch_assoc($result)) {
                    $cantidad = $row['cantidad'];
                    $codigo = $row['codigo'];
    
                    $checkStockQuery = "SELECT stock FROM producto WHERE codigo = '$codigo'";
                    $checkStockResult = mysqli_query($con, $checkStockQuery);
    
                    if ($checkStockResult) {
                        $stockRow = mysqli_fetch_assoc($checkStockResult);
                        $stockActual = $stockRow['stock'];
    
                        if ($stockActual >= $cantidad) {
                            // Actualizar el stock solo si hay suficiente
                            $updateStockQuery = "UPDATE producto SET stock = stock - $cantidad WHERE codigo = '$codigo'";
                            $updateStockResult = mysqli_query($con, $updateStockQuery);
    
                            if (!$updateStockResult) {
                                $success = false;
                            }
                        } else {
                            $success = false;
                        }
                    } else {
                        $success = false;
                    }
                }
    
                if ($success) {
                    echo "success";
                } else {
                    echo "error";
                }
            } else {
                // Error al actualizar el estado del pedido
                echo "error";
            }
    
            mysqli_close($con);
        }
    }

    public static function confirmarCompra(){
        $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");

        if(isset($_POST)){
            $id = $_POST['id'];
            $query = "UPDATE compra SET status = 2 WHERE id = $id";
            $resultado = mysqli_query($con, $query);

            if($resultado){
                $sql = "SELECT cantidad, codigo FROM detalle_compra WHERE compraid = $id";
                $resultado = mysqli_query($con, $sql);
                $success = true;

                while ($row = mysqli_fetch_assoc($resultado)) {
                    $cantidad = $row['cantidad'];
                    $codigo = $row['codigo'];

                    $sqlStock = "UPDATE producto SET stock = stock + $cantidad WHERE codigo = $codigo";
                    $result = mysqli_query($con, $sqlStock);
                }

                if ($success) {
                    echo "success";
                } else {
                    echo "error";
                }

            } else {
                // Error al actualizar el estado del pedido
                echo "error";
            }
    
            mysqli_close($con);
        }
    }

    public static function eliminar(){
        $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");
        if(isset($_POST)){
            $id = $_POST['id']; 
            $query = "SELECT compraid, total FROM detalle_compra WHERE id = $id";
            $resultado = mysqli_query($con, $query);
            $success = true;
            $errorCant = true;
            if($resultado){
                while ($row = mysqli_fetch_assoc($resultado)) {

                    $total = $row['total'];
                    $compraid = $row['compraid'];

                    $sql = "SELECT COUNT(compraid) as cantidad FROM detalle_compra WHERE compraid = $compraid";
                    $res = mysqli_query($con, $sql);

                    $rowCantidad = mysqli_fetch_assoc($res);
                    $cantidadProductos = $rowCantidad['cantidad'];

                    if ($cantidadProductos > 1) {
                        $sqltotal = "UPDATE compra SET monto = monto - $total WHERE id = $compraid";
                        $result = mysqli_query($con, $sqltotal);

                        if($result){
                            $sqlEliminar = "DELETE FROM detalle_compra WHERE id = $id";
                            $eliminar = mysqli_query($con, $sqlEliminar);
                        }
                    }else{
                        if($errorCant){
                            echo "errorCant";
                        }
                        return;
                    }

                }

                if ($success) {
                    echo "success";
                } else {
                    echo "error";
                }
            }
        } else {
            // Error al actualizar el estado del pedido
            echo "error";
        }

        mysqli_close($con);
    }

    public static function editar(){
        $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");
    
        if (isset($_POST)) {
            $id = $_POST['id'];
            $cantidad = $_POST['cantidad'];
    
            
                // Utilizar una sentencia preparada para evitar la inyección SQL
                $stmt = mysqli_prepare($con, "UPDATE detalle_compra SET cantidad = ?, total = precio * ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt, "iii", $cantidad, $cantidad, $id);
    
                $result = mysqli_stmt_execute($stmt);
    
                if ($result) {
                    // Recalcular el monto total en la tabla compra
                    $sqlRecalcularMonto = "UPDATE compra SET monto = (SELECT SUM(total) FROM detalle_compra WHERE compraid = compra.id)";
                    $resultRecalcularMonto = mysqli_query($con, $sqlRecalcularMonto);
    
                    if ($resultRecalcularMonto) {
                        echo "success";
                    } else {
                        echo "error al recalcular el monto";
                    }
                } else {
                    echo "error al actualizar detalle_compra";
                }
        } else {
            // Error al actualizar el estado del pedido
            echo "error";
        }
    
        mysqli_close($con);
    }   

    public static function eliminarCompra(){
        $con = mysqli_connect("localhost", "root", "27deagosto", "appmito");
        if($_POST['action'] == 'eliminarCompra'){
            $id = $_POST['id'];
            $sql = "DELETE FROM detalle_compra WHERE compraid = $id";
            $result = mysqli_query($con, $sql);

            if($result){
                $sql = "DELETE FROM compra WHERE id = $id";
                $resultado = mysqli_query($con, $sql);
                if($resultado){
                    echo "success";
                }else{
                    echo "error";
                }
            }else{
                echo "error";
            }

            mysqli_close($con);
        }

    }
}


?>