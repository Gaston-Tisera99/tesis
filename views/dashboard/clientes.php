<?php include_once __DIR__ .'/../templates/header.php' ?>
<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<div class="container mt-5">
    <H1>CREAR Y VER CLIENTES</H1>
    <div class="row">
        <div class="col-12">
            <div class="mt-4 mb-4">
                <button type="button" class="btn btn-success" id="openInsertModal">Ingresar Cliente</button>
            </div>
            <div class="mt-4 mb-5">
                <?php include_once __DIR__ .'/../templates/datatable.php' ?>
            </div>
        </div>
    </div>
    
</div>

  

<?php
     $script = "        
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script src='build/js/clientes.js'></script>
        
     ";     
?>

<script>
    $(document).ready(function(){
        $("#openInsertModal").click(function(){
            $('#exampleModal').modal('show');
        })
    })
</script>
