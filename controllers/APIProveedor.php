<?php

namespace Controllers;


class APIProveedor{
    public static function index(){
        include_once __DIR__ .'/../includes/config.php';
        if(isset($_POST["action"]) && $_POST["action"] === "insertarDatos"){
            $razon_social = $_POST["razon_social"];
            $cuit = $_POST["cuit"];
            $direccion = $_POST["direccion"];
            $telefono = $_POST["telefono"];
            $email = $_POST["email"];
    
            $sql = "insert into proveedores (razon_social, cuit, direccion, telefono, email) values (?, ?, ?, ?, ?)";
    
            //preparamos instruccion de sentencia sql
            $stmt = $conn->prepare($sql);
    
            if(!$stmt){
                echo "error";
            }else{
                //vinculamos parametros
                $stmt->bind_param("sssss", $razon_social, $cuit, $direccion, $telefono, $email);
    
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

    public static function editar(){
        include_once __DIR__ .'/../includes/config.php';
        if($_POST['action'] == 'obtenerDatosUsuarios'){
            $id = $_POST['id'];
            $query = "SELECT * FROM proveedores WHERE id = " .  $id;
            
            $result = $conn->query($query);
            if($result){
                $proveedores = $result->fetch_assoc();
                echo json_encode($proveedores);
            }else{
                echo json_encode(array("error" => "Hubo un error al obtener los datos del proveedor"));
            }
        }elseif($_POST['action'] == 'actualizarUsuario'){
            $id = $_POST['id'];
            $razon_social = $_POST['razon_social'];
            $cuit = $_POST['cuit'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $email = $_POST['email'];
            $query = "UPDATE proveedores set razon_social = '$razon_social', cuit = '$cuit', direccion = '$direccion', telefono = '$telefono', email = '$email' WHERE id = $id";

            if($conn->query($query)){
                echo "success";
            }else{
                echo "error";
            }
        }
        $conn->close();
    }

    public static function eliminar(){
        include_once __DIR__ .'/../includes/config.php';
        if($_POST['action'] == 'eliminarProveedor'){
            $id = $_POST['id'];
            $query = "DELETE FROM proveedores WHERE id = ?";

            $stmt = $conn->prepare($query);
            
            if(!$stmt){
                echo "error";
            }else{
                $stmt->bind_param("i", $id);

                if($stmt->execute()){
                    echo "success";
                }else{
                    echo "error";
                }

                $stmt->close();
                $conn->close();
            }
        }
    }
}


?>