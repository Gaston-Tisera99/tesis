<?php

namespace Controllers;


class APIProveedor{
    public static function index(){
        include_once __DIR__ .'/../includes/config.php';
        if(isset($_POST["action"]) && $_POST["action"] === "insertarDatos"){
            $id = $_POST["id"];
            $razon_social = $_POST["razon_social"];
            $cuit = $_POST["cuit"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $email = $_POST["email"];
    
            $sql = "insert into proveedores (id, razon_social, cuit, direccion, telefono, email) values (?, ?, ?, ?, ?, ?)";
    
            //preparamos instruccion de sentencia sql
            $stmt = $conn->prepare($sql);
    
            if(!$stmt){
                echo "error";
            }else{
                //vinculamos parametros
                $stmt->bind_param("ssssss", $id, $razon_social, $cuit, $direccion, $telefono, $email);
    
                //ejecutar sentencia sql
                if($stmt->execute()){
                    echo "success";
                }else{
                    echo "error";
                }
    
                //cerrar conexiones
                $stmt->close();
                $conn->close();
            }
            
        }
    }
}


?>