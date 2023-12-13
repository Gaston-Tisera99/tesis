<?php
namespace Controllers;

use Model\Pedido;
use Model\DetallePedido;
use Model\Categoria;
use Model\Productos;
use Model\Cliente;
use MVC\Router;

require_once "../includes/conexion.php";
class DashboardController {
    public static function dashboard(Router $router){

        $producto = new Productos;
        $pedido = new Pedido;

        if(isset($_POST)){
            $cantProductos = $producto->getDatos('producto');
            $cantClientes = $producto->getDatos('clientes');
           
            $cantVentas = $pedido->getVentas();

            $cantCompra = $producto->getCompras();

        }

        $router->render2('dashboard/dashboard', [
            'titulo' => 'Panel de Administración',
             'productos' => $cantProductos,
             'clientes' => $cantClientes,
             'pedidos' => $cantVentas,
             'compras' => $cantCompra,
        ]);
    }

    

    public static function reporteFecha(Router $router){

        $router->render2('dashboard/reporteFecha', [
        ]);
    }

    public static function stock(Router $router){

        $db = conexion();
        $sql = "SELECT c.id, c.fecha, c.monto, p.razon_social FROM compra c INNER JOIN proveedores p ON c.proveedorId  = p.id WHERE status = 1";
        $result = mysqli_query($db,$sql);   

        $router->render2('dashboard/ver-stock', [
            'db' => $db,
            'sql' => $sql,
            'result' =>$result
        ]);
    }

    public static function editarVenta(Router $router){
        if(isset($_GET)){
            $db = conexion();
            $id = $_GET['id'];
            $sql = "SELECT d.id, d.codigo, d.nombre, d.precio, d.cantidad, d.total 
            FROM detalle_pedido d inner join pedido p on d.pedidoid = p.idpedido 
            WHERE p.idpedido = '$id'";
            $result = mysqli_query($db, $sql);
        }
        $router->render2('dashboard/editarVenta', [
            'db' => $db,
            'sql' => $sql,
            'result' =>$result,
        ]);    
    }

    public static function editarCompra(Router $router){

        if(isset($_GET)){
            $db = conexion();
            $id = $_GET['id'];
            $sql = "CALL sp_ver_editar_compra($id)";
            $result = mysqli_query($db, $sql);
        }   

        $router->render2('dashboard/editarCompra', [
            'db' => $db,
            'sql' => $sql,
            'result' =>$result,
        ]);
    }
    


    public static function categorias(Router $router){
        $router->render2('dashboard/categoria', [
            
        ]);
    }

    public static function clientes(Router $router){
        $router->render2('dashboard/clientes', [
            
        ]);
    }

    public static function reportes(Router $router){
        $router->render2('dashboard/reportes', [
            
        ]);
    }

    public static function altaProducto(Router $router){
        
        $producto = new Productos;
        $categorias = Categoria::all();
        
        
        //alertas vacias
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $producto->sincronizar($_POST);
            $alertas = $producto->validarNuevoProducto();

            
            if(empty($alertas)){
                
                //verificar que el producto no este creado
                $resultado = $producto->existeProducto();
                $fechaHora = date("Y-m-d H:i:s", strtotime($_POST['datecreated']));
                $producto->datecreated = $fechaHora;

                if(empty($producto->stock)){
                    $producto->stock = 0;
                }

                if($resultado->num_rows){
                    $alertas = Productos::getAlertas();
                }else{
                    //dar de alta a un producto
                   
                    $resultado = $producto->guardar();
                    
                    if($resultado){
                        echo '<script>
                                setTimeout(function () {
                                    window.location.href = "/listar-producto";
                                    }, 2000); 
                            </script>';
                        Productos::setAlerta('exito', 'El producto se guardo correctamente');
                    }else{
                        Productos::setAlerta('error', 'No se pudo guardar el producto');
                    }

                    //obtener alertas
                    $alertas = Productos::getAlertas();
                }
                
            }
            
        }

        //renderizar las vistas
        $router->render2('dashboard/altaProducto', [
            'producto' => $producto,
            'alertas' => $alertas,
            'categorias' => $categorias
        ]);
    }

    public static function editarProducto(Router $router){  

        $id = validarORedireccionar('/dashboard');

        $producto = Productos::find($id);
        $categorias = Categoria::all();
            
       //debuguear($producto);
        if($_SERVER['REQUEST_METHOD'] === 'POST'){


            $producto->sincronizar($_POST);

            $alertas = $producto->validarNuevoProducto();

            if(empty($producto->stock)){
                $producto->stock = 0;
            }

            $producto->guardar();
            //debuguear($producto);
            header('Location:/listar-producto');
        }   

        $router->render2('dashboard/editarProducto', [
            'producto' => $producto,
            'categorias' => $categorias
        ]);
    }

        public static function bajaProducto(){
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $db = conexion();
                $id = $_POST['id'];
                $sql="CALL sp_eliminar_productos('$id')";
                //debuguear($sql);
                $resultado = mysqli_query($db,$sql);

                if($resultado){
                    echo '<script>
                        var confirmDelete = confirm("¿Desea eliminar este producto?");
                        if (confirmDelete) {
                            window.location.href = "eliminar_producto.php?id=' . $id . '";
                        } else {
                            window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
                        }
                    </script>';
                }
                
                //$producto = Productos::find($id);
                //$producto->eliminar();
                header('Location:' . $_SERVER['HTTP_REFERER']);                         
            }
        }
    public static function listarProducto(Router $router){

        $db = conexion();
        $sql ="CALL sp_mostrar_productos";
        $result=mysqli_query($db,$sql);

        $productos = Productos::all();
       //debuguear($productos);
        $router->render2('dashboard/listarProducto', [ 
            'db' => $db,
            'sql' => $sql,
            'result' =>$result,
            'productos' => $productos
        ]);
    }

    public static function detallePresupuesto(Router $router){

        $db = conexion();
        $sql = "CALL sp_ver_pedido";
        $result = mysqli_query($db,$sql);


        $router->render2('dashboard/detallePresupuesto',[
            'db' => $db,
            'sql' => $sql,
            'result' =>$result
        ]);
    }

    public static function listarVentas(Router $router){

        $db = conexion();
        $sql = "CALL sp_ver_ventas";
        $result = mysqli_query($db,$sql);

        $pedido = new Pedido;

        $total = $pedido->getTotalVentas();

        $convertir = number_format($total, 2, ',', '.');    


        $router->render2('dashboard/listarVentas',[
            'db' => $db,
            'sql' => $sql,
            'result' =>$result,
            'convertir' => $convertir
        ]);
    }

    public static function listarCompras(Router $router){
        $db = conexion();
        $sql = "SELECT id, fecha, monto FROM compra WHERE status = 2";
        $result = mysqli_query($db,$sql);

        $router->render2('dashboard/listarCompras',[
            'db' => $db,
            'sql' => $sql,
            'result' =>$result
        ]);
    }


   

    public static function pdf(Router $router){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $db = conexion();
            $id = $_POST['id'];
            $sql = "CALL ver_detalle_pedido('$id')";
            $result = mysqli_query($db, $sql);
            
        }

        $router->render2('dashboard/pdf', [
            'result' => $result,
        ]);
    }

    public static function pdfCompra(Router $router){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $db = conexion();
            $id = $_POST['id'];
            $sql = "CALL ver_detalle_compra('$id')";
            $result = mysqli_query($db, $sql);
            
        }

        $router->render2('dashboard/pdfCompra', [
            'result' => $result,
        ]);
    }

    
    
    public static function reporteProducto(Router $router){


        $categorias = Categoria::all();
        $productos = new Productos;
        
        $router->render2('dashboard/reporteProducto', [
                'categorias' => $categorias,
                'producto' => $productos,
               
        ]);

     
    }
    
    public static function cotizaciones(Router $router){
        $clientes = Cliente::all();
        $categorias = Categoria::all();
        $productos = new Productos;
        
        $resultado = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
        }

        $router->render2('dashboard/cotizaciones', [
            'clientes' => $clientes,
            'producto' => $productos,
            'resultado' => $resultado,
            'categorias' => $categorias
        ]);
    }

    public static function entrada(Router $router){

        $db = conexion();
        $sql = "SELECT id, razon_social, cuit, direccion, telefono, email FROM proveedores";
        $result = mysqli_query($db, $sql);
        //debuguear($result);
        $router->render2('dashboard/entrada', [
            'db' => $db,
            'sql' => $sql,
            'result' => $result
        ]);
    }

    
    public static function proveedor(Router $router){
        
        

        $router->render2('dashboard/proveedores', [
        ]);
    }


    public static function datos(Router $router){

        

        $router->render2('dashboard/datos', [
            
        ]);
    }

    public static function api(Router $router){
        

        $router->render2('dashboard/api', [
            
        ]);
    }



}

?>