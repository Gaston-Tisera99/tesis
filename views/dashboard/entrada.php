<?php include_once __DIR__ .'/../templates/header.php' ?>
<!-- Begin Page Content -->
<h1 class="text-center mt-5 mb-5">NUEVA ORDEN COMPRA</h1>


<body>
<div class="container">
    <div class="page-content bg-light">
        <div class="page-header bg-light">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">Nueva Compra</h2>
            </div> 
        </div>
        <section>
            <div class="container-fluid">
                <div class="col-md-3">
                  <label for="codigo">Elegir Proveedor:</label>
                    <div class="input-group">
                        <select class="form-control" id="proveedor" name="proveedor">
                            <option selected value="">-- Seleccione --</option>
                            <?php while ($ver=mysqli_fetch_assoc($result)): ?>
                            <option value="<?php echo $ver['id'];?>"><?php echo $ver['razon_social']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>       
                <form action="" method="post" id="frmCompras" class="row" autocomplete="off">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Buscar Por Nombre:</label>
                            <input type="text" name="buscar" id="buscar" onkeyup="buscarNombre(event);" placeholder="Buscar..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="buscar_codigo"><i class="fas fa-barcode"></i> Código del Producto</label>
                            <input type="hidden" id="id" name="id">
                            <input id="codigo" onkeyup="BuscarCodigo(event);" class="form-control" type="text" name="codigo" placeholder="Código">
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
                            <input id="cantidad" class="form-control" type="text" name="cantidad" onkeyup="IngresarCantidad(event);">
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
                            <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total" disabled>
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
                </form>
                <div class="row">
                    <div class="col-lg-12 mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped table-resposive" id="tablaCompras">
                                <thead>
                                    <tr class="table-dark">
                                        <th>Id</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Total</th>
                                        <th>Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="ListaCompras">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto">
                        <div class="form-group mt-2">
                            <strong class="text-primary"><i class="fas fa-ad"></i> Total a pagar: </strong>
                            <strong id="totalV"></strong><br>
                            <button class="btn btn-primary" type="button" id="procesarCompra"><i class="fas fa-ad"></i> Procesar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
    </div>
</div>
</body>
<?php
     $script = "
     <script src='build/js/compra.js'></script>
     <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
     ";
?>

