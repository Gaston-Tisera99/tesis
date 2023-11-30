<?php

namespace Model;

class Categoria extends ActiveRecord {

    protected static $tabla = 'categoria';
    protected static $columnaDB = ['id', 'nombre', 'descripcion', 'datecreated', 'status'];

    public $id;
    public $nombre;
    public $descripcion;
    public $datecreated;
    public $status;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->datecreated = $args['datecreated'] ?? '';
        $this->status = $args['status'] ?? '';
    }
}

