<?php

    require_once "database.php";

    $conexion = mysqli_connect();

    $categoria = $_POST['categoria'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $imagen = $_POST['imagen'];    
    $fechacreado = $_POST['fechacreado'];
    $estado = $_POST['estado'];

    $sql = "CALL sp_insertar_productos('$categoria','$codigo','$nombre','$descripcion','$precio','$stock','$imagen','$fechacreado','$estado')";
    echo mysqli_query($conexion, $sql);
?>