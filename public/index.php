<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIClientes;
use Controllers\APICompras;
use Controllers\LoginController;
use Controllers\DashboardController;
use Controllers\APIPedidos;
use Controllers\APICategoria;
use Controllers\APIProductos;
use Controllers\APIProveedor;

use MVC\Router;

$router = new Router();

//Iniciar Sesión
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->post('/logout', [LoginController::class, 'logout']);
//Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Crear Cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

//confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);


//area dashboard
$router->get('/dashboard', [DashboardController::class, 'dashboard']);
$router->get('/alta-producto', [DashboardController::class, 'altaProducto']);
$router->post('/alta-producto', [DashboardController::class, 'altaProducto']);
$router->post('/baja-producto', [DashboardController::class, 'bajaProducto']);
$router->get('/listar-producto', [DashboardController::class, 'listarProducto']);
$router->post('/listar-producto', [DashboardController::class, 'listarProducto']);
$router->get('/editar-producto', [DashboardController::class, 'editarProducto']);
$router->post('/editar-producto', [DashboardController::class, 'editarProducto']);  
$router->get('/reporte-producto', [DashboardController::class, 'reporteProducto']);
$router->post('/reporte-producto', [DashboardController::class, 'reporteProducto']);
$router->get('/reporte-cliente', [DashboardController::class, 'reportes']);
$router->post('/reporte-cliente', [DashboardController::class, 'reportes']);
$router->post('/cotizaciones', [DashboardController::class, 'cotizaciones']);
$router->get('/cotizaciones', [DashboardController::class, 'cotizaciones']);
$router->get('/registrar-entrada', [DashboardController::class, 'entrada']);
$router->get('/ver-stock', [DashboardController::class, 'stock']);
$router->get('/ver-stock', [DashboardController::class, 'stock']);
$router->get('/datos', [DashboardController::class, 'datos']);
$router->post('/datos', [DashboardController::class, 'datos']);
$router->get('/api', [DashboardController::class, 'api']);
$router->post('/api', [DashboardController::class, 'api']);
$router->get('/detalle-presupuesto', [DashboardController::class, 'detallePresupuesto']);
$router->post('/detalle-presupuesto', [DashboardController::class, 'detallePresupuesto']);
$router->get('/listar-ventas', [DashboardController::class, 'listarVentas']);
$router->post('/listar-ventas', [DashboardController::class, 'listarVentas']);
$router->get('/listar-compras', [DashboardController::class, 'listarCompras']);
$router->post('/listar-compras', [DashboardController::class, 'listarCompras']);
$router->get('/pdf', [DashboardController::class, 'pdf']);
$router->post('/pdf', [DashboardController::class, 'pdf']);
$router->get('/pdfCompra', [DashboardController::class, 'pdfCompra']);
$router->post('/pdfCompra', [DashboardController::class, 'pdfCompra']);
$router->get('/categorias', [DashboardController::class, 'categorias']);
$router->post('/categorias', [DashboardController::class, 'categorias']);
$router->get('/clientes', [DashboardController::class, 'clientes']);
$router->post('/clientes', [DashboardController::class, 'clientes']);
$router->get('/proveedor', [DashboardController::class, 'proveedor']);
$router->post('/proveedor', [DashboardController::class, 'proveedor']);
$router->get('/editar-compra', [DashboardController::class, 'editarCompra']);
$router->post('/editar-compra', [DashboardController::class, 'editarCompra']);
$router->get('/editar-venta', [DashboardController::class, 'editarVenta']);
$router->post('/editar-venta', [DashboardController::class, 'editarVenta']);
$router->get('/reporte-fecha', [DashboardController::class, 'reporteFecha']);
$router->post('/reporte-fecha', [DashboardController::class, 'reporteFecha']);

//API -productos
$router->get('/api/stock', [APIProductos::class, 'apiGrafico']);
$router->post('/api/stock', [APIProductos::class, 'apiGrafico']);
$router->get('/api/vendidos', [APIProductos::class, 'graficoVendidos']);
$router->post('/api/vendidos', [APIProductos::class, 'graficoVendidos']);
$router->get('/api/buscar-productos', [APIProductos::class, 'buscarProductos']);
$router->post('/api/buscar-productos', [APIProductos::class, 'buscarProductos']);  
$router->get('/api/buscar-codigo', [APIProductos::class, 'buscarCodigo']);
$router->post('/api/buscar-codigo', [APIProductos::class, 'buscarCodigo']);     
//API - pedidos
$router->get('/api/productos', [APIPedidos::class, 'index']);
$router->post('/api/productos', [APIPedidos::class, 'index']);
$router->get('/api/grafico-fecha', [APIPedidos::class, 'grafico']);
$router->post('/api/grafico-fecha', [APIPedidos::class, 'grafico']);

//API - categorias
$router->get('/api/categorias', [APICategoria::class, 'index']);
$router->post('/api/categorias', [APICategoria::class, 'index']);
$router->get('/api/listar-categorias', [APICategoria::class, 'listar']);
$router->post('/api/listar-categorias', [APICategoria::class, 'listar']);
$router->get('/api/eliminar-categorias', [APICategoria::class, 'eliminar']);
$router->post('/api/eliminar-categorias', [APICategoria::class, 'eliminar']);
$router->get('/api/editar-categorias', [APICategoria::class, 'editar']);
$router->post('/api/editar-categorias', [APICategoria::class, 'editar']);

//API -PROVEEDOR
$router->get('/api/proveedor', [APIProveedor::class, 'index']);
$router->post('/api/proveedor', [APIProveedor   ::class, 'index']);
$router->get('/api/editar-proveedor', [APIProveedor::class, 'editar']);
$router->post('/api/editar-proveedor', [APIProveedor::class, 'editar']);
$router->get('/api/eliminar-proveedor', [APIProveedor::class, 'eliminar']);
$router->post('/api/eliminar-proveedor', [APIProveedor::class, 'eliminar']);

//API - clientes
$router->get('/api/clientes', [APIClientes::class, 'index']);
$router->post('/api/clientes', [APIClientes::class, 'index']);
$router->get('/api/nuevo-clientes', [APIClientes::class, 'nuevo']);
$router->post('/api/nuevo-clientes', [APIClientes::class, 'nuevo']);
$router->get('/api/editar-clientes', [APIClientes::class, 'editar']);
$router->post('/api/editar-clientes', [APIClientes::class, 'editar']);
$router->get('/api/eliminar-clientes', [APIClientes::class, 'eliminar']);
$router->post('/api/eliminar-clientes', [APIClientes::class, 'eliminar']);

//API - COMPRAS - VENTAS
$router->get('/api/buscar-producto', [APICompras::class, 'buscar']);
$router->post('/api/buscar-producto', [APICompras::class, 'buscar']);
$router->get('/api/buscar-nombre', [APICompras::class, 'nombre']);
$router->post('/api/buscar-nombre', [APICompras::class, 'nombre']);
$router->get('/api/ingresar-producto', [APICompras::class, 'ingresar']);
$router->post('/api/ingresar-producto', [APICompras::class, 'ingresar']);
$router->get('/api/guardar-producto', [APICompras::class, 'guardar']);
$router->post('/api/guardar-producto', [APICompras::class, 'guardar']);
$router->get('/api/confirmar-venta', [APICompras::class, 'confirmar']);
$router->post('/api/confirmar-venta', [APICompras::class, 'confirmar']);
$router->get('/api/confirmar-compra', [APICompras::class, 'confirmarCompra']);
$router->post('/api/confirmar-compra', [APICompras::class, 'confirmarCompra']);
$router->get('/api/eliminar-compra', [APICompras::class, 'eliminar']);
$router->post('/api/eliminar-compra', [APICompras::class, 'eliminar']);
$router->get('/api/eliminar-item', [APICompras::class, 'eliminarItem']);
$router->post('/api/eliminar-item', [APICompras::class, 'eliminarItem']);
$router->get('/api/editar-compra', [APICompras::class, 'editar']);
$router->post('/api/editar-compra', [APICompras::class, 'editar']);
$router->get('/api/editar-cantidad', [APICompras::class, 'editarCantidad']);
$router->post('/api/editar-cantidad', [APICompras::class, 'editarCantidad']);
$router->get('/api/eliminar', [APICompras::class, 'eliminarCompra']);
$router->post('/api/eliminar', [APICompras::class, 'eliminarCompra']);
$router->get('/api/eliminar-venta', [APICompras::class, 'eliminarVenta']);
$router->post('/api/eliminar-venta', [APICompras::class, 'eliminarVenta']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();