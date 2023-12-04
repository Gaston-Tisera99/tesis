<?php include_once __DIR__ .'/../templates/header.php' ?>

<body>
    
    <h1 class="text-center mt-5 mb-5">VENTAS CONFIRMADAS</h1>
    <div class="container">
        
        <div class="row">
        <div class="col-xl-3 col-6">
                <div class="card bg-success">  
                    <div class="card-body d-flex text-white">
                        TOTAL VENDIDO HOY
                        <i class="fas fa-thin fa-cart-plus fa-2x ml-auto"></i>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <span class ="text-white"><?php echo '$'.$convertir?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-5">
                <table id="myTable" class="table table-hover table-resposive" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <td class="col-2">Id Venta</td>
                                <td>Cliente</td>
                                <td>Fecha</td>
                                <td>Monto</td>
                                <td style="text-align: center;" class="col-2">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ($ver=mysqli_fetch_assoc($result)):
                            ?>
                            <tr>
                                <td><?php echo $ver['idpedido']; ?></td>
                                <td><?php echo $ver['nombre']; ?></td>
                                <td><?php echo $ver['fecha']; ?></td>
                                <td><?php echo $ver['monto']; ?></td>
                                <td style="text-align: center;">
                                    <form method="POST" target ="_blank" action="/pdf" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $ver['idpedido']; ?>">  
                                        <input type="submit" value="VER VENTA" class="btn btn-raised btn-success btn-xs">
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
        <script src='build/js/ventas.js'></script>
        
     ";     
?>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
            "order": [[2, "desc" ]],
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        }
        });
    })
</script>

