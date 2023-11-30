<?php
    namespace Controllers;

    use Model\Categoria;
use mysqli;
use mysqli_result;

    class APICategoria {
        public static function index(){

            if(isset($_POST)){
                    $nombre = $_POST['nombre'];
                    $descripcion = $_POST['descripcion'];
                    $fecha = $_POST['fecha'];
                if(empty ($_POST['idp'])){
                    $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
                    $sql = "CALL sp_crear_categoria('$nombre', '$descripcion', '$fecha')";
                    $result = mysqli_query($db, $sql);
                    if ($result) {
                        // La consulta se ejecutó con éxito, por lo tanto, la inserción se realizó correctamente.
                        echo "ok";
                    } else {
                        // Hubo un error en la consulta, puedes manejar el error de otra manera si es necesario.
                        echo "Error en la consulta SQL";
                    }
        
                    mysqli_close($db);
                }else{
                    $id = $_POST['idp'];
                    $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
                    $sql = "UPDATE categoria set nombre = '$nombre', descripcion = '$descripcion', datecreated = '$fecha' WHERE id = '$id'";
                    $result = mysqli_query($db, $sql);
                    if ($result) {
                        // La consulta se ejecutó con éxito, por lo tanto, la inserción se realizó correctamente.
                        echo "modificado";
                    } else {
                        // Hubo un error en la consulta, puedes manejar el error de otra manera si es necesario.
                        echo "Error en la consulta SQL";
                    }
                }
           
            }
                
            
           
        }

        public static function listar(){

                $categorias = Categoria::all();
                $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
                $sql = "SELECT * FROM categoria ORDER BY id ASC";
                $resultado = mysqli_query($db, $sql);
                

                $data = file_get_contents("php://input");

                if($data != ""){
                    $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
                    $sql = ("SELECT * FROM categoria WHERE id LIKE '%".$data."%' OR nombre LIKE '%".$data."%' OR descripcion LIKE '%".$data."%'");
                    $resultado = mysqli_query($db, $sql);
                }
                
                foreach($resultado as $data){
                        echo "<tr>
                        <td>".$data['id']."</td>
                        <td>".$data['nombre']."</td>
                        <td>".$data['descripcion']."</td>
                        <td>".$data['datecreated']."</td>
                        <td>
                            <button type='button' class='btn btn-warning mx-2' onclick=Editar('".$data['id']."')><i class='fas fa-edit'></i></button>
                            <button type='button' class='btn btn-danger mx-2' onclick=Eliminar('".$data['id']."')><i class='fas fa-trash'></i></button>
                        </td>
                    </tr>";
            }
        }
        public static function eliminar(){
           
            $id = file_get_contents("php://input");
            $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
            $sql = "DELETE FROM categoria WHERE id = $id";
            $result = mysqli_query($db, $sql);
            if ($result) {
                // La consulta se ejecutó con éxito, por lo tanto, la inserción se realizó correctamente.
                echo "ok";
            } else {
                // Hubo un error en la consulta, puedes manejar el error de otra manera si es necesario.
                echo "Error en la consulta SQL";
            }

            mysqli_close($db);
        }

        public static function editar(){
            $id = file_get_contents("php://input");
            $db = mysqli_connect('localhost', 'root', '27deagosto', 'appmito');
            $sql = "SELECT * FROM categoria WHERE id = $id";
            $result = mysqli_query($db, $sql);
            $resultado = mysqli_fetch_assoc($result);
            echo json_encode($resultado);  
           
        }

    }
    
?>