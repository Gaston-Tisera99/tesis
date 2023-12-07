$(document).ready(function(){
    $(document).on('click', '.confirmar', function() {
        var id = $(this).data('id');
        mostrarConfirmacionCompra(id);
    })

});

function mostrarConfirmacionCompra(id){
Swal.fire({
    title: '¿Seguro que desea confirmar la COMPRA?',
    text: 'Esta acción no se podrá deshacer',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Si, confirmar',
    cancelButtonText: 'Cancelar',
}).then((result) => {
    if(result.isConfirmed){
        ConfirmarRegistro(id);
    }
})
}

function ConfirmarRegistro(id){

    $.post('/api/confirmar-compra', {
        action : 'confirmarCompra',
        id : id
    }, function(response){
        if(response.trim() == 'success'){
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: 'COMPRA Confirmada Correctamente',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo confirmar la COMPRA',
            });
        }
    })
}


$(document).ready(function(){
    $('.eliminar-btn').click(function (){
        var id = $(this).data('id');
        mostrarConfirmacionEliminar(id);
    });

    function mostrarConfirmacionEliminar(id){
        Swal.fire({
            title: '¿Seguro que deseas eliminar este registro?',
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

    //funcion para eliminar

    function eliminarRegistro(id) {
        $.post('/api/eliminar', {
            action: 'eliminarCompra',
            id: id
        }, function(response) { // Coloca la función de manejo dentro del $.post
            if (response.trim() === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Usuario eliminado correctamente',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al eliminar el cliente',
                });
            }
        });
    }
})