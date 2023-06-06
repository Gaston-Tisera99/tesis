<?php

namespace Controllers;

use MVC\Router;

class TiendaController{
    public static function index( Router $router){
        $router->render2('tienda/index', [

        ]);
    } 
}