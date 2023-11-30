<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<?php include_once __DIR__ .'/../templates/header.php' ?>
<body>
    <H1>CREAR Y VER LAS CATEGORIAS</H1>
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-secondary">
                    <h3 class="text-center">REGISTRO DE CATEGORIAS</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" id="frm">
                            <div class="form-group">
                                <label for="">Nombre:</label>
                                <input type="hidden" name="idp" id="idp">
                                <input type="text" name="nombre" id="nombre" placeholder="nombre" class="form-control">
                            </div>
                            <div class="form-group" >
                                <label for="">Descripcion:</label>
                                <textarea type="text" name="descripcion" id="descripcion" placeholder="descripcion" class="form-control h-100"></textarea>
                            </div>
                            <div class="form-group" >
                                <label for="">Fecha:</label>
                                <input type="date" name="fecha" id="fecha" placeholder="fecha" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="button" value="Registrar" id="registrar" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-6 ml-auto">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Buscar:</label>
                                <input type="text" name="buscar" id="buscar" placeholder="Buscar..." class="form-control">
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-hover table-resposive">
                    <thead>
                        <tr class="table-dark">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha Creada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="resultado">

                    </tbody>
                </table>    
            </div>
        </div>
    </div>
    <?php
     $script = "
     <script src='build/js/categoria.js'></script>
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js'></script>
     ";
?>
</body>
</html>