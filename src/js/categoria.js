ListarCategorias();
function ListarCategorias(busqueda){
    fetch("/api/listar-categorias",{
        method: 'POST',
        body: busqueda
    }).then(response => response.text()).then(response =>{
        resultado.innerHTML = response;
    })
}

var registrar = document.getElementById('registrar');

registrar.addEventListener("click", async () => {

    try {
        const url = '/api/categorias';
        const respuesta = await fetch(url, {
            method: 'POST',
            body: new FormData(frm)
        }).then(response => response.text()).then(response => {
            if(response == "ok"){
                Swal.fire({
                    icon: 'success',
                    title: 'Registrado',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }else if(response === "modificado"){
                Swal.fire({
                    icon: 'success',
                    title: 'modificado',
                    showConfirmButton: false,
                    timer: 1500
                  })
            }
            registrar.value = "Registrar";
            idp.value="";
            frm.reset();
            ListarCategorias(); 
        });
    } catch (error) {
        console.log('Error en la solicitud: ', error);
    }
});

function Eliminar(id){
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI!',
        cancelButtonText: 'NO'
      }).then((result) => {
        if (result.isConfirmed) {
            fetch("/api/eliminar-categorias", {
                method: "POST",
                body: id
            }).then(response => response.text()).then(response =>{
                if(response == "ok"){
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
                frm.reset();
                ListarCategorias(); 
            })
          
        }
      })
}

function Editar(id) {
    fetch('/api/editar-categorias', {
        method: "POST",
        body: id
    }).then(response => response.json()).then(response => {
        idp.value = response.id;
        nombre.value = response.nombre;
        descripcion.value = response.descripcion;
        
        const date = new Date(response.datecreated);
        const formattedDate = date.toISOString().split('T')[0];
        fecha.value = formattedDate;
        
        registrar.value = "Actualizar";
    });
}

buscar.addEventListener("keyup", ()=>{
    const valor = buscar.value;
    if (valor == ""){
        ListarCategorias();
    }else{
        ListarCategorias(valor);
    }
});