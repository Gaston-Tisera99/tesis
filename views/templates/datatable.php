<!DOCTYPE html>
<html lang="en">

<?php include_once __DIR__ . '/../../includes/config.php' ?>
<div class="table-responsivo">
    <table class="table table-hover table-resposive" id="data-table">
        <thead>
            <tr class="table-dark">
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>telefono</th>
                <th>cuit</th>
                <th>email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT id, nombre, apellido, direccion, telefono, cuit, email FROM clientes";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                //resultado sobre la fila
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['nombre'] . '</td>';
                    echo '<td>' . $row['apellido'] . '</td>';
                    echo '<td>' . $row['direccion'] . '</td>';
                    echo '<td>' . $row['telefono'] . '</td>';
                    echo '<td>' . $row['cuit'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-warning mx-2 btn-editar" data-id="'.$row['id'].'"><i class="fas fa-edit"></i></button>';
                    echo '<button class="btn btn-danger mx-2 eliminar-btn" data-id="'.$row['id'].'"><i class="fas fa-trash"></i></i></button>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan=5> No hay datos disponibles.</td></tr>';
            }
            //cerramos conexion
            $conn->close();
            ?>
        </tbody>
    </table>
</div>


<!--MODAL!-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo Cliente</h5>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="txtnombre">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Apellido:</label>
                        <input type="text" class="form-control" id="txtapellido">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Direccion:</label>
                        <textarea class="form-control" id="txtdireccion"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Telefono:</label>
                        <input type="number" class="form-control" id="txttelefono" oninput="limitarNumero(this, 10)"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">dni:</label>
                        <input type="number" class="form-control" id="txtdni" oninput="limitarNumero(this, 8)"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">cuit:</label>
                        <input type="text" class="form-control" maxlength="13" id="txtcuit"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">email:</label>
                        <input type="text" class="form-control" id="txtemail"></input>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="Registrar_usuario()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Actualizar -->
<div class="modal fade" id="modal_actualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar los datos del cliente </h5>
            </div>
            <div class="modal-body">
                <form>
                    <input type="text" id="editUserId">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nombre:</label>
                        <input type="text" class="form-control" id="txtnombre_actualizar">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Apellido:</label>
                        <input type="text" class="form-control" id="txtapellido_actualizar">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Direccion:</label>
                        <textarea class="form-control" id="txtdireccion_actualizar"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Telefono:</label>
                        <input type="number" class="form-control" id="txttelefono_actualizar" oninput="limitarNumero(this, 10)"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">dni:</label>
                        <input type="number" class="form-control" id="txtdni_actualizar" oninput="limitarNumero(this, 8)"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">cuit:</label>
                        <input type="text" class="form-control" maxlength="13" id="txtcuit_actualizar"></input>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">email:</label>
                        <input type="text" class="form-control" id="txtemail_actualizar"></input>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnActualizar" onclick="Actualizar_usuario()">Actualizar</button>
            </div>
        </div>
    </div>
</div>
<!-- Abrir Modal -->


<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    })  
    $(document).ready(function(){
        $('#data-table').on('click', '.btn-editar', function(){
            var id = $(this).data('id');
            $('#modal_actualizar').modal('show');
            cargarDatosClientes(id);
        })
    })

    function limitarNumero(input, maxLength) {
    let value = input.value;

    // Elimina cualquier caracter que no sea un número
    value = value.replace(/\D/g, '');

    // Limita la longitud del número
    if (value.length > maxLength) {
        value = value.slice(0, maxLength);
    }

    // Actualiza el valor del campo de entrada
    input.value = value;
}

</script>
<script src='build/js/app.js'></script>

</html>