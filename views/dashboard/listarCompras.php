<?php include_once __DIR__ .'/../templates/header.php' ?>

<body>
    
    <h1 class="text-center mt-5 mb-5">COMPRAS CONFIRMADAS</h1>
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 mt-5">
                <table id="myTable" class="table table-hover table-resposive" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <td class="col-2">Id Pedido</td>
                                <td>Proveedor</td>
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
                                <td><?php echo $ver['id']; ?></td>
                                <td>Proveedor</td>
                                <td><?php echo $ver['fecha']; ?></td>
                                <td><?php echo $ver['monto']; ?></td>
                                <td style="text-align: center;">
                                <form method="POST" target ="_blank" action="/pdfCompra" class="d-inline">
                                        <input type="hidden" name="id" value="<?php echo $ver['id']; ?>">  
                                        <input type="submit" value="Ver Orden" class="btn btn-raised btn-success btn-xs">
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
        $('#myTable').DataTable();
    })
</script>

