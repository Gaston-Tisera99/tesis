//funcion registrar
function registrarProveedor(){
    var razon_social = document.getElementById("txtrazon_social").value;
    var cuit = document.getElementById("txtcuit").value; 
    var direccion = document.getElementById("txtdireccion").value;
    var telefono = document.getElementById("txttelefono").value;
    var email = document.getElementById("txtemail").value;

    //validar campos vacios
    if(razon_social === "" || cuit === "" || direccion === "" || telefono === "" || email === ""){
        return Swal.fire({
            title: "Atención",
            text: "Primero debes completar los campos!",
            icon: "warning"
          });
    }

    //solicitar a Ajax para envio de datos
    $.ajax({
        url:"/api/proveedor",
        type:"POST",
        data: {
            action:"insertarDatos",
            razon_social : razon_social,
            cuit : cuit,
            direccion : direccion, 
            telefono : telefono,
            email : email
        },
        success: function(response){
            if(response === "success"){
                $('#exampleModal').modal('hide');

                //limpiar campos
                document.getElementById("txtrazon_social").value = "";
                document.getElementById("txtcuit").value = "";
                document.getElementById("txtdireccion").value = "";
                document.getElementById("txttelefono").value = "";
                document.getElementById("txtemail").value = "";

                //recargar pagina
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: 'Proveedor registrado correctamente!',
                }).then((result) =>{
                    if(result.isConfirmed){
                        $('#modal_actualizar').modal('hide');
                        setTimeout(() => {
                           location.reload(); 
                        }, 1000);
                    }
                })
            }else{
                Swal.fire(
                    'Ups!',
                    'No se guardaron los datos',
                    'error'
                );
            }
        },
        error: function(){
            Swal.fire(
                'Ups, hubo un error en Ajax!',
                'No se enviaron los datos',
                'error'
            );
        }
    });
}

function cargarDatosProveedor(id){
    $.ajax({
        url: "/api/editar-proveedor",
        type: "POST",
        data : {
            action: "obtenerDatosUsuarios",
            id: id
        },
        success : function(respuesta){
            try {
                 datosUsuario = JSON.parse(respuesta);
                 console.log(datosUsuario)
                 document.getElementById("editUserId").value = id;
                 document.getElementById("txtrazon_social_actualizar").value = datosUsuario.razon_social
                 document.getElementById("txtcuit_actualizar").value = datosUsuario.cuit
                 document.getElementById("txtdireccion_actualizar").value = datosUsuario.direccion
                 document.getElementById("txttelefono_actualizar").value = datosUsuario.telefono
                 document.getElementById("txtemail_actualizar").value = datosUsuario.email
                $('#modal_actualizar').modal('show');
            } catch (error) {
                console.error("Error al procesar la respuesta de JSON: " + error);
                alert("Hubo un problema al cargar los datos del usuario");
            }
        },
        error : function(xhr, status, error){
            console.error("Error en la solicitud de AJAX: " + error);
            alert('Hubo un error al cargar los datos del usuario');
        }
    })
}

//actualizar

function Actualizar_usuario(){
    var id = document.getElementById("editUserId").value;
    var razon_social = document.getElementById("txtrazon_social_actualizar").value;
    var cuit = document.getElementById("txtcuit_actualizar").value; 
    var direccion = document.getElementById("txtdireccion_actualizar").value;
    var telefono = document.getElementById("txttelefono_actualizar").value;
    var email = document.getElementById("txtemail_actualizar").value;

    if(razon_social.length == "" || cuit.length == "" || direccion.length == "" || telefono.length == "" || email.length == ""){
        return Swal.fire({
            title: 'Estimado Administrador',
            text: 'No está permitido campos vacíos',
            icon: 'error'
        });
    }

    $.ajax({
        url: "/api/editar-proveedor",
        method: "POST",
        data : {
            action : "actualizarUsuario",
            id : id,
            razon_social : razon_social,
            cuit : cuit,
            direccion : direccion,
            telefono : telefono,
            email : email
        },
        success : function(response){
            response = response.trim();
            if(response === "success"){
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: 'Proveedor actualizado correctamente!',
                }).then((result) =>{
                    if(result.isConfirmed){
                        $('#modal_actualizar').modal('hide');
                        setTimeout(() => {
                           location.reload(); 
                        }, 1000);
                    }
                });
            }else{
                Swal.fire({
                    icon : 'error',
                    title : 'Error',
                    text : 'Hubo un error al actualizar el proveedor',
                });
            }
        },
        error : function(xhr, status, error){
            console.error("Error en la solicitud ajax " + error);
            alert('Hubo un error al cargar los datos del proveedor')
        }
    })
}

//eliminar un proveedor

$(document).ready(function(){
    $('.eliminar-btn').click(function(){
        var id = $(this).data('id');
        mostrarConfirmacionEliminar(id);
    });

    function mostrarConfirmacionEliminar(id){
        Swal.fire({
            title : '¿Seguro que desea eliminar este proveedor?',
            icon : 'warning',
            text : 'Esta accion no se podra deshacer',
            showCancelButton : true,
            confirmButtonText : 'Si, eliminar',
            cancelButtonText : 'Cancelar'
        }).then((result) =>{
            if(result.isConfirmed){
                eliminarRegistro(id);
            }
        });
    }

    //function que elimina

    function eliminarRegistro(id){
        $.post('/api/eliminar-proveedor', {
            action : 'eliminarProveedor',
            id : id
        }, function(response){
            if (response.trim() === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Proveedor eliminado correctamente',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al eliminar el proveedor',
                });
            }
        });
    }

});



