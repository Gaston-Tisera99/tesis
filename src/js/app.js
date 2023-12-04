var data=[];
var cant=0;

var boton=document.getElementById('agregar');
var guardar=document.getElementById('guardar');

boton.addEventListener("click",agregar);
guardar.addEventListener("click",save);
const nombrePro = document.getElementById("buscar");
const codigoPro = document.getElementById("codigo");

function BuscarCodigo(event) {
    event.preventDefault();
    const id = document.getElementById("codigo").value;
    if (event.key == "Enter") {
        nombrePro.disabled = true;
        codigoPro.disabled = true;
        // Luego, puedes realizar la solicitud AJAX para buscar el producto

        $.ajax({
            url: '/api/buscar-producto',    
            type: 'POST',
            data: {
                id: id // Enviar el código de barras como "id"
            },
            success: function (response) {
                const res = JSON.parse(response)
                if(res){
                    document.getElementById("nombre").value = res.nombre;
                    document.getElementById("precio").value = res.precio;
                    document.getElementById("id").value = res.id;
                    document.getElementById("buscar").value = '';
                    document.getElementById("cantidad").focus();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Codigo de producto inexistente',
                        showConfirmButton : false,
                        timer: 2000
                    })
                   document.getElementById("codigo").value = '';
                   document.getElementById("buscar").value = '';
                    document.getElementById("codigo").focus();
                    nombrePro.disabled = false;
                    codigoPro.disabled = false;
                }
                
            }
        });
        
    }
}

function buscarNombre(event){
    event.preventDefault();
    const nombre = document.getElementById("buscar").value;
    if(event.key == "Enter"){
        nombrePro.disabled = true;
        codigoPro.disabled = true;
        $.ajax({
            url : '/api/buscar-nombre',
            type: 'POST',
            data : {
                nombre : nombre
            },
            success : function(response){
                const res = JSON.parse(response) 
                if(res){
                    document.getElementById("codigo").value = res.codigo;
                    document.getElementById("nombre").value = res.nombre;
                    document.getElementById("precio").value = res.precio;
                    document.getElementById("id").value = res.id;
                    document.getElementById("cantidad").focus();
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Nombre de producto inexistente',
                        showConfirmButton : false,
                        timer: 2000
                    })
                    document.getElementById("codigo").value = '';
                    document.getElementById("buscar").value = '';
                    document.getElementById("buscar").focus();
                    nombrePro.disabled = false;
                    codigoPro.disabled = false;
                }
            }
        })
    }

}

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
    document.getElementById("buscar").value = "";
    nombrePro.disabled = false;
    codigoPro.disabled = false;
}


function agregar(){
    const cantidad = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    const nombre = document.getElementById("nombre").value; 
    const idProducto = document.getElementById("id").value;
    const codigo = document.getElementById("codigo").value;
    var total=precio*cantidad;
    

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

    if (isNaN(cantidad) || cantidad <= 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Elija una cantidad válida',
            showConfirmButton: false,
            timer: 2000
        });
        return; // Detener la ejecución si la cantidad no es válida
    }

    data.push(
        {"id":cant,"idProducto":idProducto,"codigo":codigo,"nombre":nombre,"precio":precio,"cantidad":cantidad,"total":total}
    );

  var id_row='row'+cant;
  var fila='<tr id='+id_row+'><td>'+codigo+'</td><td>'+nombre+'</td><td>'+precio+'</td><td>'+cantidad+'</td><td>'+total+'</td><td><a href="#" class="btn btn-danger" style="margin-right: 10px;" onclick="eliminar('+cant+')";>Eliminar</a><a href="#" class="btn btn-warning" onclick="cantidad('+cant+')";>Cantidad</a></td></tr>';
  //agregar fila a la tabla
  $("#lista tbody").append(fila);

  document.getElementById("cantidad").value = "";
  document.getElementById("precio").value = "";
  document.getElementById("nombre").value = "";
  document.getElementById("id").value = "";
  document.getElementById("codigo").value = "";
  document.getElementById("sub_total").value = "";
  document.getElementById("buscar").value = "";

  nombrePro.disabled = false;
  codigoPro.disabled = false;
  // Poner el foco en el campo "codigo" para continuar escaneando
  document.getElementById("buscar").focus();
  cant++;
  sumar();
}

function sumar(){
    let tot=0;
    for (x of data){
       tot=tot+x.total;
    }
    document.querySelector("#precioTotal").innerHTML="Total a pagar: "+tot;
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


function calcularPrecioTotal(row) {
    var cantidad = parseFloat(row.querySelector('.cantidad').value);
    var precioPorUnidad = parseFloat(row.querySelector('.precio').value);
    
    if (!isNaN(cantidad) && !isNaN(precioPorUnidad)) {
        var precioTotal = cantidad * precioPorUnidad;
        row.querySelector('.precioTotal').value = precioTotal.toFixed(2); // Mostrar con dos decimales
    } else {
        row.querySelector('.precioTotal').value = ''; // Limpiar el campo si no se pueden realizar cálculos
    }
}


function save(){
    
    var json = JSON.stringify(data); 
    var cliente = document.querySelector("#cliente").value;
    var precioTotalDiv = document.getElementById("precioTotal");
    var contenido = precioTotalDiv.textContent;
    var valorNumerico = parseFloat(contenido.match(/\d+(\.\d+)?/));
    
    if (cliente.trim() === '') {
        mostrarAlerta("Error", "Por favor, elija un cliente válido.", "error");
        return; // Detener la ejecución si no se eligió un cliente
    }
    
    if (isNaN(valorNumerico) || valorNumerico <= 0) {
        // Monto no válido
        mostrarAlerta("Error", "Por favor, ingrese al menos un  producto.", "error");
        return;
    }

    $.ajax({
        type: "POST",
        url: "/api",
        data: {
            json: json,
            cliente: cliente,
            monto: valorNumerico,
        }
    }).done(function(response){
        console.log(response);
        if(response){
            
            mostrarAlerta("Éxito", response, "success");
            Swal.fire({
                icon: 'success',
                title: 'Exito',
                text: 'El PEDIDO se registro con exito!',
                showConfirmButton: false,
                timer: 2000
            });
            setTimeout(() => {
                $("#lista tbody").empty();
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
        document.getElementById("cliente").value = "";
       
   }

    
    function mostrarAlerta(titulo, descripcion, tipoAlerta) {
        Swal.fire(
            titulo,
            descripcion,
            tipoAlerta
        );
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






