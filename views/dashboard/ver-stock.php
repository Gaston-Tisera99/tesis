<?php include_once __DIR__ .'/../templates/header.php' ?>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<body>
    <h1 class="text-center mt-5 mb-5" >ORDENES DE COMPRA</h1>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
            <table id="myTable" class="table table-hover table-resposive" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <td class="col-2">Id Compra</td>
                               <td>Proveedor</td>
                                <td>Fecha</td>
                                <td>Monto</td>
                                <td>EDITAR O ELIMINAR</td>
                                <td style="text-align: center;" class="col-2">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($ver=mysqli_fetch_assoc($result)):
                            ?>
                            <tr>
                                <td><?php echo $ver['id']; ?></td>
                                <td><?php echo $ver['razon_social']; ?></td>
                                <td><?php echo $ver['fecha']; ?></td>
                                <td><?php echo $ver['monto']; ?></td>
                                <td>
                                    <input type="hidden" name="id" value="<?php echo $ver['id']; ?>">
                                    <a href="editar-compra?id=<?php echo $ver['id']; ?>" class="btn btn-warning mx-2 btn-editar">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    <input type="hidden" name="id" value="<?php echo $ver['id']; ?>">
                                    <button class="btn btn-danger mx-2 eliminar-btn" data-id="<?php echo $ver['id']; ?>"><i class="fas fa-trash"></i></i></button>
                                </td>
                                <td style="text-align: center;">
                                    <form action="" method="POST" class="d-inline"> 
                                        <button type="button" class="btn btn-raised btn-warning btn-xs confirmar mx-2" data-id="<?php echo $ver['id']; ?>">CONFIRMAR ORDEN</button>
                                    </form>
                                    <form method="POST" target ="_blank" action="/pdfCompra" class="d-inline mx-2">
                                        <input type="hidden" name="id" value="<?php echo $ver['id']; ?>">  
                                        <input type="submit" value="VER ORDEN" class="btn btn-raised btn-success btn-xs">
                                    </form>   
                                </td>
                            </tr>
                            <?php 
                                endwhile;
                            ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<?php
     $script = "        
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='build/js/ordenCompra.js'></script>
        
     ";     
?>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
            "order": [[2, "desc" ]],
            "columns": [
            null,
            null,
            null,
            null,
            null,
            { "width": "22%" }
        ],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
        });
    })
</script>