<?php

namespace Model;

class Productos extends ActiveRecord {
    
    protected static $tabla = 'producto';
    protected static $columnasDB = ['id', 'categoriaid', 'codigo', 'nombre', 'descripcion', 'precio', 'stock', 'datecreated'];

    public $id;
    public $categoriaid;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $datecreated;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->categoriaid = $args['categoriaid'] ?? null;
        $this->codigo = $args['codigo'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->descripcion = $args['descripcion'] ?? null;
        $this->precio = $args['precio'] ?? null;
        $this->stock = $args['stock'] ?? null;
        $this->datecreated = $args['datecreated'] ?? null;
    }

    //Mensajes de validacion para la creacion de un producto
    public function validarNuevoProducto(){
        if(!$this->categoriaid){
            self::$alertas['error'][] = 'La categoria del producto es obligatorio';
        }
        if(!$this->codigo){
            self::$alertas['error'][] = 'El codigo del producto es obligatorio';
        }
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre del producto es obligatorio';
        }   
        if(!$this->descripcion){    
            self::$alertas['error'][] = 'La descripcion del producto es obligatorio';
        }   
        if(!$this->precio){
            self::$alertas['error'][] = 'El precio del producto es obligatorio';
        }   
        if($this->precio <= 0){
            self::$alertas['error'][] = 'El precio del producto tiene que ser mayor a cero';
       }
        // if(!$this->stock){
        //     self::$alertas['error'][] = 'El stock del producto es obligatorio';
        // } 
        if(empty($this->stock)){
            $this->stock = 0;
        }else if($this->stock < 0){
            self::$alertas['error'][] = 'El stock del producto no puede ser negativo';
        }   
        if(!$this->datecreated){
            'La fecha de creacion del producto es obligatorio';
        }      
 
        return self::$alertas;
    }

    public function existeProducto(){
        $query = "SELECT * FROM " . self::$tabla. " WHERE codigo = " . $this->codigo . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$alertas['error'][] = 'Ya existe un producto con este numero de codigo';    
        }
        return $resultado;
    }

    public function eliminarProducto($id){

        $sqlEliminar = "CALL sp_eliminar_productos($id)";
        $resultado = self::$db->query($sqlEliminar);
        return $resultado;
        
    }

    public function buscarProducto(string $cod){
        $sql = "SELECT * FROM producto WHERE codigo = '$cod'";
        $resultado = self::$db->query($sql);
        return $resultado;
    }

    public function buscarNombre(string $nom){
        $sql = "SELECT * FROM producto WHERE nombre LIKE '%$nom%'";
        $resultado = self::$db->query($sql);
        return $resultado;
    }

    public function getProducto(string $id){
        $sql = "SELECT * FROM producto WHERE id = '$id'";
        $resultado = self::$db->query($sql);
        return $resultado;
    } 
    
    public function getStock(){
        $sql = "SELECT * FROM producto ORDER BY stock asc LIMIT 5;";
        $resultado = self::$db->query($sql);
        
        // Inicializar un array para almacenar todos los resultados
        $resultados = array();
        
        // Recorrer todas las filas y agregarlas al array
        while ($fila = $resultado->fetch_assoc()) {
            $resultados[] = $fila;
        }
    
        return $resultados;
    }

    public function getVendidos(){
        $sql = "SELECT sum(d.cantidad) vendidos, p.id as id_producto ,p.nombre as nombre_producto
        FROM detalle_pedido d inner join producto p on P.id  = d.productoid
        GROUP BY d.productoid order by vendidos desc limit 5";
        $resultado = self::$db->query($sql);
        
        // Inicializar un array para almacenar todos los resultados
        $resultados = array();
        
        // Recorrer todas las filas y agregarlas al array
        while ($fila = $resultado->fetch_assoc()) {
            $resultados[] = $fila;
        }
    
        return $resultados;

    }

    
}