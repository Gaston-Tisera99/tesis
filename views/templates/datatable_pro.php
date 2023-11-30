
<!-- Estilos DataTable -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/../../includes/config.php' ?>
<div class="table-responsivo">
    <table class="table table-hover table-resposive" id="data-table"> 
        <thead>
            <tr class="table-dark"> 
                <th>ID</th>
                <th>Razon Social</th>
                <th>CUIT</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>E-mail</th>
                <!-- <th class="text">Acciones</th> -->
            </tr>
        </thead>

        <tbody>
        <!-- consulta BD -->
        <?php
            $query = "select id, razon_social, cuit, direccion, telefono, email from proveedores";
            //ejecutamos consulta
            $result = $conn->query($query);


            if($result->num_rows > 0){
                //resultados sobre la fila
                while($row = $result->fetch_assoc()){
                    echo '<tr>';
                    echo '<td>' .$row['id']. '</td>';
                    echo '<td>' .$row['razon_social']. '</td>';
                    echo '<td>' .$row['cuit']. '</td>';
                    echo '<td>' .$row['direccion']. '</td>';
                    echo '<td>' .$row['telefono']. '</td>';
                    echo '<td>' .$row['email']. '</td>';
                    echo '</tr>';
                }
            }else{
                echo '<tr><td colspan="6"> No hay datos disponibles.</td></tr>';
            }

            //cerramos conexion a bd
            $conn->close();
        ?>
        </tbody>
    </table>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="exampleModalLabel">Agregar Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="id-name" class="col-form-label">Id:</label>
                            <input type="text" class="form-control" id="txtid">
                        </div>
                        <div class="mb-3">
                            <label for="razon-social-text" class="col-form-label">Razon Social:</label>
                            <input type="text" class="form-control" id="txtrazon_social">
                        </div>
                        <div class="mb-3">
                            <label for="cuit-text" class="col-form-label">CUIT:</label>
                            <input type="text" class="form-control" id="txtcuit">
                        </div>
                        <div class="mb-3">
                            <label for="direccion-text" class="col-form-label">Direccion:</label>
                            <input type="text" class="form-control" id="txtdireccion">
                        </div>
                        <div class="mb-3">
                            <label for="telefono-text" class="col-form-label">Telefono:</label>
                            <input type="text" class="form-control" id="txttelefono">
                        </div>
                        <div class="mb-3">
                            <label for="email-text" class="col-form-label">E-mail:</label>
                            <input type="text" class="form-control" id="txtemail">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="registrarProveedor()">Guardar</button>
                </div>
            </div>
        </div>
    </div>

<!-- CDN jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- CDN DataTable -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- config dataTable-->
<script>
    $(document).ready(function(){
        $('#data-table').DataTable();
    });
</script>






















<!-- CDN jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<!-- CDN DataTable -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- config dataTable-->
<script>
    $(document).ready(function(){
        $('#data-table').DataTable();
    });
</script>




















