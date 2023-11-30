<?php

namespace Model;

class DetallePedido extends ActiveRecord {

    protected static $tabla = 'detalle_pedido';
    protected static $columnasDB = ['id', 'pedidoid', 'productoid', 'precio', 'cantidad', 'codigo', 'nombre', 'total'];

    public $id;
    public $pedidoid;
    public $productoid;
    public $precio;
    public $cantidad;
    public $codigo;
    public $nombre;
    public $total;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->pedidoid = $args['pedidoid'] ?? null;
        $this->productoid = $args['productoid'] ?? null;
        $this->precio = $args['precio'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->codigo = $args['codigo'] ?? null;
        $this->nombre = $args['nombre']  ?? null;
        $this->total = $args['total'] ?? null;
    }

    

    
}

?>