<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Tienda Virtual">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Gaston Tisera"> 
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <style>
        label {
            font-size: 16px; /* Tamaño de letra para las etiquetas */
        }

        textarea {
            font-size: 16px; /* Tamaño de letra para el textarea */
        }
    </style>
</head>
<?php include_once __DIR__ .'/../templates/header.php' ?>
<body>
<div class="container">
    <h1 class="text-center text-uppercase mt-5">Crear Nuevo Producto</h1>

    <?php 
        include_once __DIR__ . "/../templates/alertas.php";
    ?>
        <form class="formulario mt-5 mb-5" action="alta-producto" method="post" enctype="multipart/form-data" id="frmAgrega">
            
            <div class="row mb-3">
            <div class="mt-4 mb-4">
                <a href="/listar-producto" class="btn btn-success">Volver</a>
            </div>
                <div class="col-6">
                    <label for="categoria">Categoria:</label>
                    <select class="form-control" id="categoria" name="categoriaid">
                        <option selected value="">-- Seleccione --</option>
                         <?php foreach($categorias as $categoria){?> 
                        <option 
                            <?php echo $producto->categoriaid === $categoria->id ? 'selected' : ''; ?>
                            value="<?php echo s($categoria->id); ?>"><?php echo s($categoria->nombre); ?></option>
                        <?php }?>  
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="codigo">Código:</label>
                <div class="col-6">
                    <input class="form-control" type="number" id="codigo" name="codigo" value="<?php echo s($producto->codigo)?>"><br>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nombre">Nombre:</label>
                <div class="col-6">
                    <input class="form-control" type="text" id="nombre" name="nombre" value="<?php echo s($producto->nombre)?>"><br>
                </div>
            </div>

            <div class="row mb-3">
                <label for="descripcion">Descripción:</label>
                <div class="col-6">
                    <textarea class="form-control h-100" id="descripcion" name="descripcion"><?php echo s($producto->descripcion)?></textarea><br>
                </div>
            </div>

            <div class="row mb-3">
                <label for="precio">Precio:</label>
                <div class="col-6">
                    <input class="form-control" type="number" id="precio" name="precio" value="<?php echo s($producto->precio)?>"><br>
                </div>
            </div>

            <div class="row mb-3"> 
                <label for="stock">Stock:</label>
                <div class="col-6">
                    <input class="form-control" type="number" id="stock" name="stock" value="<?php echo s($producto->stock)?>"><br>
                </div>
            </div>

            <div class="row mb-3">
                <label for="fechacreado">Fecha creado:</label>
                <div class="col-6">
                <input class="form-control" type="datetime-local" id="fechacreado" name="datecreated" value="<?php echo s($producto->datecreated); ?>" required><br>
                </div>
            </div>
            
            
            <input type="submit" class="btn btn-primary" value="Guardar Producto">
        </form>

    </div>
    
</body>

</html>