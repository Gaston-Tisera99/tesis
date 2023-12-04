
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;700;900&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span> 
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            PEDIDOS
          </a>
          <ul class="dropdown-menu">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/cotizaciones">NUEVO PEDIDO</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/detalle-presupuesto">PEDIDOS</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/listar-ventas">VENTAS CONFIRMADAS </a></li>

          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            COMPRA
          </a>
          <ul class="dropdown-menu">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/registrar-entrada">NUEVA ORDEN DE COMPRA</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/ver-stock">ORDENES DE COMPRAS</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="/listar-compras">COMPRAS CONFIRMADAS</a></li>
          </ul>
        </li> 
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            REPORTES
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="reporte-producto">REPORTE DE UN PRODUCTO</a></li>
            <li><a class="dropdown-item" href="reporte-fecha">REPORTE POR FECHA</a></li>
            <li><a class="dropdown-item" href="reporte-cliente">REPORTE DE UN CLIENTE</a></li>
          </ul>
        </li> 
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <form method="POST" action="/logout">
              <input type="submit" value="Cerrar Sesión" class="btn btn-primary btn-block">
          </form>
          
        </li>
      </ul>
    </div>
  </div>
</nav>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>  