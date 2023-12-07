<?php include_once __DIR__ .'/../templates/header.php' ?>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<body>
    <h1 class="text-center mt-5 mb-5" >EDITAR ORDEN DE COMPRA</h1>
    <div class="container">
        <div class="row">
            <div class="mt-4 mb-4">
                <a href="/detalle-presupuesto" class="btn btn-success">Volver</a>
            </div>
            <div class="col-lg-12 mt-5">
            <table id="myTable" class="table table-hover table-resposive" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <td class="col-2">Codigo</td>
                                <td>Nombre</td>
                                <td>Precio</td>
                                <td>Total</td>
                                <td>Editar Cantidad</td>
                                <td style="text-align: center;" class="col-2">Eliminar Producto</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($ver = mysqli_fetch_assoc($result)):
                            ?>           
                            <tr>
                                <td><?php echo $ver['codigo']; ?></td>
                                <td><?php echo $ver['nombre']; ?></td>
                                <td><?php echo $ver['precio']; ?></td>
                                <td><?php echo $ver['total']; ?></td>
                                <td>
                                    <input type="number" min="1" id="cantidad" class="cantidad-input" name="<?php echo $ver['id']; ?>" value="<?php echo $ver['cantidad']; ?>">
                                </td>
                                <td style="text-align: center;">
                                    <button type="submit" class="btn btn-danger mx-2 eliminar-btn" data-id="<?php echo $ver['id']; ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr> 
                            <?php 
                                endwhile;
                            ?>                     
                        </tbody>
                        
                </table>
                <button type="button" class="btn btn-primary actualizar" onclick="Actualizar_cantidad()">Actualizar Cantidad</button>               
            </div>
        </div>
    </div>
</body>
<?php
     $script = "        
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='build/js/editarVenta.js'></script>
        
     ";     
?>
