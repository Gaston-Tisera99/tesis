$(document).ready(function(){
    $('.eliminar-btn').click(function (){
        var id = $(this).data('id');
        mostrarConfirmacionEliminar(id);
    })

    function mostrarConfirmacionEliminar(id){
        Swal.fire({
            title: '¿Seguro que deseas eliminar este producto de la orden?',
            text: 'Esta accion no se podra deshacer',   
            icon: 'warning',
            showCancelButton: true, 
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if(result.isConfirmed){
                eliminarRegistro(id);
            }
        })
    }

    function eliminarRegistro(id) {
        $.post('/api/eliminar-compra', {
            action: 'eliminar',
            id: id
        }, function(response) { // Coloca la función de manejo dentro del $.post
            if (response.trim() === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Producto eliminado correctamente',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else if(response.trim() === 'errorCant'){
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se puede eliminar un producto que es el unico de la compra',
                });
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se puede eliminar este producto',
                });
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    
});

function Actualizar_cantidad(){

    var tabla = document.getElementById("myTable");

    for (var i = 0; i < tabla.rows.length; i++) {
        // Obtener la referencia de la fila actual
        var fila = tabla.rows[i];

        // Obtener el valor del input number en la cuarta celda de la fila actual
        var valorInput = fila.cells[4].querySelector('.cantidad-input');

        // Imprimir el valor en la consola y guardar en el array
        if (valorInput) {
            var valor = valorInput.value;

            if (parseFloat(valor) < 1) {
                return Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La cantidad no puede ser menor a 1',
                });

            }
        }
    }

    var cantidadInputs = document.querySelectorAll('.cantidad-input');
    var newData = [];

    cantidadInputs.forEach(function (input) {
        var cantidad = input.value;
        var id = input.name;

            newData.push({ id: id, cantidad: cantidad });
    });

    Swal.fire({
        title: '¿Seguro que deseas editar las cantidades?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, Editar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            // You might want to consider updating multiple records at once instead of one by one
            newData.forEach(function (data) {
                editarRegistro(data.id, data.cantidad);
            });
        }
    });
}

function editarRegistro(id, cantidad) {
    $.post('/api/editar-compra', {
        cantidad: cantidad,
        id: id
    }, function (response) {
        if (response.trim().toLowerCase() === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'Cantidad editada correctamente',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        } else if (response.trim().toLowerCase() === 'errorcant') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La cantidad no puede ser menor a 1',
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al editar la cantidad',
            });
        }
    });
}