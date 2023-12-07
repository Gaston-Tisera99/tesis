
function Registrar_usuario(){
    var nombre = document.getElementById("txtnombre").value;
    var apellido = document.getElementById("txtapellido").value;
    var direccion = document.getElementById("txtdireccion").value;
    var telefono = document.getElementById("txttelefono").value;
    var dni = document.getElementById("txtdni").value;
    var cuit = document.getElementById("txtcuit").value;
    var email = document.getElementById("txtemail").value;

    //validamos con js campos vacios

    if(nombre === "" || apellido === "" || direccion === "" || telefono === "" || dni === "" || cuit === "" || email === ""){
        Swal.fire({
            title: 'Estimado Administrador',
            text: 'No está permitido campos vacíos',
            icon: 'error'
        });
    }

    //solicitud a ajax
    $.ajax({
        url: "/api/nuevo-clientes",
        type: "POST",
        data:{
            action:"insertarDatos",
            nombre : nombre,
            apellido : apellido,
            direccion : direccion,
            telefono : telefono,
            dni : dni,
            cuit : cuit,
            email : email
        },
        success : function(respuesta){
            if(respuesta === "success"){
                $("#exampleModal").modal('hide');

                //limpiamos los campos
                document.getElementById("txtnombre").value = "";
                document.getElementById("txtapellido").value = "";
                document.getElementById("txtdireccion").value = "";
                document.getElementById("txttelefono").value = "";
                document.getElementById("txtdni").value = "";
                document.getElementById("txtcuit").value = "";
                document.getElementById("txtemail").value = "";

                //Recargar la pagina
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: 'Cliente registrado correctamente!',
                }).then((result) =>{
                    if(result.isConfirmed){
                        $('#modal_actualizar').modal('hide');
                        setTimeout(() => {
                           location.reload(); 
                        }, 1000);
                    }
                })

            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops Hubo un error',
                    text: 'No se pudo insertar los datos!',
                  })
            }
        },
        error: function(){
            Swal.fire({
                icon: 'error',
                title: 'Oops Hubo un error en AJAX',
                text: 'No se pudo insertar los datos!',
              });
        }
    });
}

//cargar los datos de los clientes

function cargarDatosClientes(id){
    $.ajax({
        url: "/api/editar-clientes",
        type: "POST",
        data : {
            action: "obtenerDatosUsuarios",
            id: id
        },
        success : function(respuesta){
            try {
                var datosUsuario = JSON.parse(respuesta);
                document.getElementById("editUserId").value = id;
                document.getElementById("txtnombre_actualizar").value = datosUsuario.nombre;
                document.getElementById("txtapellido_actualizar").value = datosUsuario.apellido;
                document.getElementById("txtdireccion_actualizar").value = datosUsuario.direccion;
                document.getElementById("txttelefono_actualizar").value = datosUsuario.telefono;
                document.getElementById("txtdni_actualizar").value = datosUsuario.dni;
                document.getElementById("txtcuit_actualizar").value = datosUsuario.cuit;
                document.getElementById("txtemail_actualizar").value = datosUsuario.email;
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
    var nombre = document.getElementById("txtnombre_actualizar").value;
    var apellido = document.getElementById("txtapellido_actualizar").value;
    var direccion = document.getElementById("txtdireccion_actualizar").value;
    var telefono = document.getElementById("txttelefono_actualizar").value;
    var dni = document.getElementById("txtdni_actualizar").value;
    var cuit = document.getElementById("txtcuit_actualizar").value;
    var email = document.getElementById("txtemail_actualizar").value;

    if(nombre === "" || apellido === "" || direccion === "" || telefono === "" || dni === "" || cuit === "" || email === ""){
        return Swal.fire({
            title: 'Estimado Administrador',
            text: 'No está permitido campos vacíos',
            icon: 'error'
        });
    }


    $.ajax({
        url: "/api/editar-clientes",
        type: "POST",
        data : {
            action: "actualizarUsuario",
            id:id,
            nombre:nombre,
            apellido:apellido,
            direccion:direccion,
            telefono:telefono,
            dni:dni,
            cuit:cuit,
            email:email
        },
        success: function(response){
            response  = response.trim();

            if(response === "success"){
                Swal.fire({
                    icon: 'success',
                    title: 'Exito',
                    text: 'Cliente actualizado correctamente!',
                }).then((result) =>{
                    if(result.isConfirmed){
                        $('#modal_actualizar').modal('hide');
                        setTimeout(() => {
                           location.reload(); 
                        }, 1000);
                    }
                })
            }else{
                swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al actualizar los datos del cliente',
                })
            }
            
        },
        error : function(xhr, status, error){
            console.error("Error en la solicitud de AJAX: " + error);
            alert('Hubo un error al actualizar los datos del usuario');
        }       
    })
}

//eliminar datos del cliente

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
        $.post('/api/eliminar-clientes', {
            action: 'eliminarUsuario',
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

});