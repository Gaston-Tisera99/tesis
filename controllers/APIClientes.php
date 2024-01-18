<?php
    
    namespace Controllers;
    
    class APIClientes {
        public static function index(){
            $db = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

            if (isset($_POST['fecha1']) && isset($_POST['fecha2'])) {
                $fecha1 = $_POST['fecha1'];
                $fecha2 = $_POST['fecha2'];

                $sql = "CALL sp_ver_grafico_clientes('$fecha1', '$fecha2')";
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

            

            echo json_encode(['error' => 'Ambas fechas deben proporcionarse']);
            mysqli_close($db);
        }

        public static function nuevo(){
            include_once __DIR__ .'/../includes/config.php';
            if(isset($_POST["action"]) && $_POST["action"] === "insertarDatos"){
                $nombre = $_POST["nombre"];
                $apellido = $_POST["apellido"];
                $direccion = $_POST["direccion"];
                $telefono = $_POST["telefono"];
                $dni = $_POST["dni"];
                $cuit = $_POST["cuit"];
                $email = $_POST["email"];

                $sql = "INSERT INTO clientes(nombre, apellido, direccion, telefono, dni, cuit, email) values(?, ?, ?, ?, ? ,?, ?)";
                //preparamos la instruccion de la sentencia en sql

                $stmt = $conn->prepare($sql);
                if(!$stmt){
                    echo "error";
                }else{
                    //vinculamos los parametros
                    $stmt->bind_param("sssssss", $nombre, $apellido, $direccion, $telefono, $dni, $cuit, $email);
                    //ejecutar la sentencia sql
                    if($stmt->execute()){   
                        echo "success";
                    }else{
                        echo "error";
                    }
                    //cierre de conexiones
                    $stmt->close();
                    $conn->close();
                }
            }
        }

        public static function editar(){
            include_once __DIR__ .'/../includes/config.php';
            if($_POST['action'] == 'obtenerDatosUsuarios'){
                $id = $_POST['id'];
                $query = "SELECT * FROM clientes WHERE id = " . $id;
                $result = $conn->query($query);
                if($result){
                    $cliente = $result->fetch_assoc();
                    echo json_encode($cliente);
                }else{
                    echo json_encode(array("error" => "Hubo un error al obtener los datos del cliente"));
                }
            }elseif($_POST['action'] == 'actualizarUsuario'){
                $id = $_POST['id'];
                $nombre = $_POST['nombre'];
                $apellido = $_POST['apellido'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $dni = $_POST['dni'];
                $cuit = $_POST['cuit'];
                $email = $_POST['email'];
                $query = "UPDATE clientes set nombre = '$nombre', apellido = '$apellido', direccion = '$direccion', telefono = '$telefono', dni = '$dni', cuit = '$cuit', email = '$email' WHERE id = $id";

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
            if($_POST['action'] == 'eliminarUsuario'){
                $id = $_POST['id'];
                //preparamos la consulta sql
                $query = "DELETE FROM clientes WHERE id = ?";

                //preparamos la sentencia sql
                $stmt = $conn->prepare($query);

                if(!$stmt){
                    echo "error";
                }else{
                    //vinculacion a un parametro
                    $stmt->bind_param("i", $id);
                    //ejecutamos
                    if($stmt->execute()){
                        echo "success";
                    }else{
                        echo "error";
                    }

                    //cierre de conexiones
                    $stmt->close();
                    $conn->close();
                }
            }
        }
    }
?>