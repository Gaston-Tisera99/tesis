<style>
#productos {
    height: 50vh;
    overflow-y: scroll;
}

#precioTotal {
    font-weight: bold;
    font-size: 15px;
}

.navbar-nav .nav-item .nav-link {
    font-size: 15px;
    padding: 10px 20px;
}

.big-button {
    font-size: 10px;

}

.head {
    background: #343a40;
    color: white;
}
</style>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título en Negrita con Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="../src/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body class="app sidebar-mini">

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <img src="../img/logo.jpg" alt="imagen" width="50px">
                MITO LIMPIEZA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            ADMINISTRAR PRODUCTOS
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="listar-producto">PRODUCTOS</a></li>
                            <li><a class="dropdown-item" href="/categorias">CATEGORIAS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/clientes" role="button" aria-expanded="false">
                            CLIENTES
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/proveedor" role="button" aria-expanded="false">
                            PROVEEDORES
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            VENTAS
                        </a>
                        <ul class="dropdown-menu list-unstyled">
                            <li class="nav-item"><a class="dropdown-item" href="/cotizaciones">NUEVO PEDIDO</a></li>
                            <li class="nav-item"><a class="dropdown-item" aria-current="page"
                                    href="/detalle-presupuesto">PEDIDOS</a>
                            </li>
                            <li class="nav-item"><a class="dropdown-item" aria-current="page"
                                    href="/listar-ventas">VENTAS CONFIRMADAS</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            COMPRA
                        </a>
                        <ul class="dropdown-menu list-unstyled">
                            <li class="nav-item"><a class="dropdown-item" href="/registrar-entrada">NUEVA COMPRA</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="/ver-stock">TODAS LAS COMPRAS</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="/listar-compras">COMPRAS CONFIRMADAS</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            REPORTES
                        </a>
                        <ul class="dropdown-menu list-unstyled">
                            <li><a class="dropdown-item" href="reporte-producto">REPORTE DE UN PRODUCTO</a></li>
                            <li><a class="dropdown-item" href="reporte-cliente">REPORTE DE UN CLIENTE</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="/logout">
                            <input type="submit" value="Cerrar Sesión" class="btn btn-primary">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <h1 class="text-center mt-5 mb-5">CREAR UN NUEVO PEDIDO</h1>
        <div class="row">
            <div class="col-sm">
                <p>Nuevo Pedido</p>
            </div>
        </div>
        <form method="POST" class="formulario" action="cotizaciones" id="formulario">
            <div class="row mb-3">
                
                <div class="col-md-3">
                    <label for="codigo">Elegir Cliente:</label>
                    <div class="input-group">
                        <select class="form-control" id="cliente" name="cliente">
                            <option selected value="">-- Seleccione --</option>
                            <?php foreach ($clientes as $cliente) { ?>
                            <option value="<?php echo s($cliente->id); ?>">
                                <?php echo s($cliente->nombre . ' ' . $cliente->apellido); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <form action="" method="post" id="frmCompras" class="row" autocomplete="off">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">Buscar Por Nombre:</label>
                        <input type="text" name="buscar" id="buscar" onkeyup="buscarNombre(event);" placeholder="Buscar..." class="form-control">
                    </div>
                </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="codigo"><i class="fas fa-barcode"></i> Buscar Por Codigo:</label>
                    <input type="hidden" id="id" name="id">
                    <input id="codigo" onkeyup="BuscarCodigo(event);" class="form-control" type="text"
                        name="codigo" placeholder="Código">
                    <span class="text-danger d-none" id="error"><i class="fas fa-ad"></i> No hay producto</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="nombre">Producto</label>
                    <input id="nombre" class="form-control" type="text" name="nombre" disabled>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input id="cantidad" class="form-control" type="text" name="cantidad"
                        onkeyup="IngresarCantidad(event);">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="precio"><i class="fas fa-ad"></i> Precio</label>
                    <input id="precio" class="form-control" type="text" name="precio" disabled>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label for="sub_total"><i class="fas fa-ad"></i> Sub Total</label>
                    <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total"
                        disabled>
                    <br />
                    <strong id="subTotalP"></strong>
                </div>
            </div>
            <div class="col-lg-3 mt-4">
                <div class="form-group">
                    <button type="button" class="btn btn-success mt-3" id="agregar" style="margin-right: 10px;">Agregar</button>
                    <button type="button" class="btn btn-danger mt-3" id="cancelar" style="margin-right: 10px;">Cancelar</button>
                </div>
            </div>
            <div class="col-lg-5">
                <button type="button" class="btn btn-primary mt-3" id="guardar" style="margin-right: 10px;">Guardar</button>             
            </div>    
        </form>
        
        <br>
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="table-responsive">
                    <div id="productos">
                        <table class="table-hover table-bordered mt-5" style="width:100%" id="lista">
                            <thead class="head">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>   
                            </tbody>
                        </table>
                        <div class="col-lg-3 mt-5">
                            <div class="col-10 text-right mt-5" id="precioTotal" name="precioTotal"></div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    <?php
     $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='build/js/app.js'></script>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js'></script>
     ";
     
?>


    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>