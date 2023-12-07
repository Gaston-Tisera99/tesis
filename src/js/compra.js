var data=[];
var cant=0;

var boton=document.getElementById('agregar');
var guardar=document.getElementById('procesarCompra');

boton.addEventListener("click",agregar);
guardar.addEventListener("click",save);
//const nombrePro = document.getElementById("buscar");
//const codigoPro = document.getElementById("codigo");

document.getElementById("campo").addEventListener("keyup", getCodigos)

function getCodigos(){

    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("list")

    if(inputCP.length > 0){
        let url = "/api/buscar-productos";
        let formData = new FormData()
        formData.append("campo", inputCP);
    
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(response => response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))
    }else{
        lista.style.display = 'none';
    }

   
}

function mostrar(id, codigo, nombre, precio) {
    let lista = document.getElementById("list");
    lista.style.display = 'none';
    document.getElementById("id").value = id;   
    document.getElementById("codigo").value = codigo;
    document.getElementById("nombre").value = nombre;
    document.getElementById("precio").value = precio;

    document.getElementById("cantidad").focus();

    document.getElementById("campo").value = "";
}

// function BuscarCodigo(event) {
//     event.preventDefault();
//     const id = document.getElementById("codigo").value;
//     if (event.key === "Enter") {
//         nombrePro.disabled = true;
//         codigoPro.disabled = true;
        

//         $.ajax({
//             url: '/api/buscar-producto',
//             type: 'POST',
//             data: {
//                 id: id // Enviar el código de barras como "id"
//             },
//             success: function (response) {
//                 const res = JSON.parse(response)
//                 if(res){
//                     document.getElementById("nombre").value = res.nombre;
//                     document.getElementById("precio").value = res.precio;
//                     document.getElementById("id").value = res.id;
//                     document.getElementById("buscar").value = '';
//                     document.getElementById("cantidad").focus();
//                 }else{
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: 'Codigo de producto inexistente',
//                         showConfirmButton : false,
//                         timer: 2000
//                     })
//                     document.getElementById("codigo").value = '';
//                     document.getElementById("codigo").focus();
//                     nombrePro.disabled = false;
//                     codigoPro.disabled = false;
//                 }
                
//             }
//         });
//     }
// }


// function buscarNombre(event){
//     event.preventDefault();
//     const nombre = document.getElementById("buscar").value;
//     if(event.key == "Enter"){
//         nombrePro.disabled = true;
//         codigoPro.disabled = true;
//         $.ajax({
//             url : '/api/buscar-nombre',
//             type: 'POST',
//             data : {
//                 nombre : nombre
//             },
//             success : function(response){
//                 const res = JSON.parse(response) 
//                 if(res){
//                     document.getElementById("codigo").value = res.codigo;
//                     document.getElementById("nombre").value = res.nombre;
//                     document.getElementById("precio").value = res.precio;
//                     document.getElementById("id").value = res.id;
//                     document.getElementById("cantidad").focus();
//                 }else{
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: 'Nombre de producto inexistente',
//                         showConfirmButton : false,
//                         timer: 2000
//                     })
//                     document.getElementById("codigo").value = '';
//                     document.getElementById("buscar").value = '';
//                     document.getElementById("buscar").focus();
//                     nombrePro.disabled = false;
//                     codigoPro.disabled = false;
//                 }
//             }
//         })
//     }

// }

function IngresarCantidad(e){
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    document.getElementById("sub_total").value = precio * cant;
}

var cancel=document.getElementById('cancelar');
cancel.addEventListener("click",cancelar);

function cancelar(){
    document.getElementById("cantidad").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("id").value = "";
    document.getElementById("codigo").value = "";
    document.getElementById("sub_total").value = "";
    
    document.getElementById("proveedor").value = "";
    //nombrePro.disabled = false;
    //codigoPro.disabled = false;
}


function agregar(e){
     
    const idProducto = document.getElementById("id").value;
    const codigo = document.getElementById("codigo").value;
    const nombre = document.getElementById("nombre").value;
    const cantidad = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    const total = document.getElementById("sub_total").value;
    

    if (codigo === '' || nombre === '' || precio === '' || cantidad === '') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No está permitido campos vacíos',
            showConfirmButton: false,
            timer: 2000
        });
        document.getElementById("cantidad").value = "";
        document.getElementById("precio").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("sub_total").value = "";
        return; // Detener la ejecución si la cantidad no es válida
        
    }

    data.push(
        {"id":cant,"idProducto":idProducto,"codigo":codigo,"nombre":nombre,"precio":precio,"cantidad":cantidad,"total":total}
    );

    var id_row='row'+cant;
    var fila='<tr id='+id_row+'><td>'+codigo+'</td><td>'+nombre+'</td><td>'+precio+'</td><td>'+cantidad+'</td><td>'+total+'</td><td><a href="#" class="btn btn-danger" style="margin-right: 10px;" onclick="eliminar('+cant+')";>Eliminar</a><a href="#" class="btn btn-warning" onclick="cantidad('+cant+')";>Cantidad</a></td></tr>';
    //agregar fila a la tabla
    $("#tablaCompras tbody").append(fila);

    document.getElementById("cantidad").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("id").value = "";
    document.getElementById("codigo").value = "";
    document.getElementById("sub_total").value = "";
   

    //nombrePro.disabled = false;
    //codigoPro.disabled = false;

    
    cant++;
    sumar();
}


function sumar(){
    let tot=0;
    for (x of data){
        tot += parseFloat(x.total);
    }
    document.querySelector("#totalV").innerHTML=tot;
} 

function cantidad(row){
    var canti = parseFloat(prompt("Nueva Cantidad"));
    data[row].cantidad = canti;
    if (isNaN(data[row].cantidad) || data[row].cantidad <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Elija una cantidad válida',
            showConfirmButton: false,
            timer: 2000
        });
        return; // Detener la ejecución si la cantidad no es válida
    }
    data[row].total = data[row].cantidad*data[row].precio;
    var filaid = document.getElementById("row" + row);
    celda=filaid.getElementsByTagName('td');
    celda[3].innerHTML = canti;
    celda[4].innerHTML = data[row].total;
    sumar();
}



function save(){
    
    var json = JSON.stringify(data); 
    var proveedor = document.getElementById("proveedor").value;
    var precioTotalDiv = document.getElementById("totalV");
    var contenido = precioTotalDiv.textContent;
    var valorNumerico = parseFloat(contenido.match(/\d+(\.\d+)?/));

    console.log(proveedor)

    if (proveedor.trim() === '') {
        mostrarAlerta("Error", "Por favor, elija un proveedor válido.", "error");
        return; // Detener la ejecución si no se eligió un cliente
    }
    
    if (isNaN(valorNumerico) || valorNumerico <= 0) {
        // Monto no válido
        mostrarAlerta("Error", "Por favor, ingrese al menos un  producto.", "error");
        return;
    }

    $.ajax({
        type: "POST",
        url: "/api/guardar-producto",
        data: {
            json: json,
            proveedor : proveedor,
            monto: valorNumerico,
        }
    }).done(function(response){
        console.log(response);
        if(response){
            
            mostrarAlerta("Éxito", response, "success");
            Swal.fire({
                icon: 'success',
                title: 'Exito',
                text: 'La compra se registro con exito!',
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(() => {
                $("#tablaCompras tbody").empty();
                $("#precioTotal").empty();
            }, 2000);
        }else{
            mostrarAlerta("Error", response, "error");
        }
        })  

        
        document.getElementById("cantidad").value = "";
        document.getElementById("precio").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("id").value = "";
        document.getElementById("codigo").value = "";
        document.getElementById("sub_total").value = "";
        document.getElementById("proveedor").value = "";
   }

   function eliminar(row){
    //remover la fila de la tabla html
    $("#row"+row).remove();
    var i=0;
    var pos = 0;
    for(x of data){
        if(x.id==row){
            pos=i;
        }
        i++;
    }
    data.splice(pos,1);
    sumar();
}

    
    function mostrarAlerta(titulo, descripcion, tipoAlerta) {
        Swal.fire(
            titulo,
            descripcion,
            tipoAlerta
        );
    }


