<?php

namespace Model;

class Cliente extends ActiveRecord {
    protected static $tabla = 'clientes';
    protected static $columnaDB = ['id', 'nombre', 'apellido', 'direccion', 'telefono', 'dni', 'cuit', 'email'];

    public $id; 
    public $nombre;
    public $apellido;
    public $direccion;
    public $telefono;
    public $dni;
    public $cuit;
    public $email;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->dni = $args['dni'] ?? '';
        $this->cuit = $args['cuit'] ?? '';
        $this->email = $args['email'] ?? '';
    }
}