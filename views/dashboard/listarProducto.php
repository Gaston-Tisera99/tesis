<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
    <?php include_once __DIR__ .'/../templates/header.php' ?>
<style>
    table.dataTable thead {
        background: #343a40;
        color: white;
    }

</style>

<body>

<h1 class="text-center mt-5 mb-5">CREAR Y VER LOS PRODUCTOS</h1>
<div class="container">
    <div class="row">
        <div class="mt-4 mb-4">
            <a href="/alta-producto" class="btn btn-success">Crear Producto</a>
        </div>
        <div class="col-lg-12 mt-5">
            <table id="myTable" class="table table-hover table-resposive" style="width:100%">
                    <thead >
                        <tr class="table-dark">
                            <td>codigo</td>
                            <td>nombre</td>
                            <td>descripcion</td>
                            <td>precio</td>
                            <td>stock</td>
                            <td>creado</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Sort the $productos array by datecreated in descending order

                            foreach($productos as $producto){       
                        ?>
                        <tr>
                            <td><?php echo $producto->codigo ?></td>
                            <td><?php echo $producto->nombre ?></td>
                            <td><?php echo $producto->descripcion ?></td>
                            <td><?php echo $producto->precio ?></td>
                            <td><?php echo $producto->stock ?></td>  
                            <td><?php echo $producto->datecreated?></td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">  
                                <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                                <a href="editar-producto?id=<?php echo $producto->id; ?>" class="btn btn-warning mx-2 btn-editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="baja-producto" method="POST" id="formulario" onsubmit="return confirmarEliminar();" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $producto->id; ?>">  
                                    <button type="submit" class="btn btn-danger mx-2 eliminar-btn">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                
                
            </table>
        </div>
    </div>
</div>
    
</body>
<script>
    $(document).ready(function(){
        $('#myTable').DataTable({
            "order": [[5, "desc" ]],
            "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        });
    })
</script>

<script src='build/js/app.js'></script>
</html>