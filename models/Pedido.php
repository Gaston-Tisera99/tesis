<?php

namespace Model;

class Pedido extends ActiveRecord {
    
    protected static $tabla = 'pedido';
    protected static $columnasDB = ['idpedido', 'clienteid', 'fecha', 'monto', 'status'];

    public $idpedido;
    public $clienteid;
    public $fecha;
    public $monto;
    public $status;

    public function __construct($args = []){
        $this->idpedido = $args['idpedido'] ?? null;
        $this->clienteid = $args['clienteid'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
        $this->monto = $args['monto'] ?? null;
        $this->status = $args['status'] ?? null;
    }

    //Mensajes de validacion para la creacion de un producto
    public function validarNuevoPrespuesto(){
        if(!$this->clienteid){
            self::$alertas['error'][] = 'El cliente es obligatorio';
        } 
        if(!$this->monto){    
            self::$alertas['error'][] = 'El monto es obligatorio';
        }   

        return self::$alertas;
    }

    public function getVentas(){
        $sql = "SELECT COUNT(*) AS total FROM pedido WHERE status = 2";
        $resultado = self::$db->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['total'];
    }

    public function getTotalVentas(){
        $sql = "SELECT SUM(monto) as monto FROM pedido WHERE status = 2 and date_format(fecha, '%d-%m-%Y') = date_format(now(), '%d-%m-%Y')";
        $resultado = self::$db->query($sql);
        $fila = $resultado->fetch_assoc();
        return $fila['monto'];
    }

}