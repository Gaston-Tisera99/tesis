<?php include_once __DIR__ .'/../templates/header.php' ?>
<h1>GRAFICO DE CLIENTES</h1>
      <div class="container">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <label for="fechaDesde">Seleccione Una Fecha Desde</label>
                        <div class="input-group">
                            <input type="date" id="fechaDesde" class="form-control" name="fechaDesde">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="fechaHasta">Seleccione Una Fecha Hasta</label>
                        <div class="input-group">
                            <input type="date" id="fechaHasta" class="form-control" name="fechaHasta">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn btn-raised btn-success btn-xs mt-4" id="buscar" name="buscar">BUSCAR</button>
                    </div>
                </div>
            </form>
        </div>
      <div>
      <div class="dashboard__grafica chart-container">
            <canvas id="grafico-clientes" width="400" height="400"></canvas>
      </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>
<script>

$(document).ready(function () {

let myChart;

$('#buscar').on('click', function () {
    enviarFecha();
});

function enviarFecha() {
    const fecha1 = document.getElementById('fechaDesde').value;
    const fecha2 = document.getElementById('fechaHasta').value;

    $.ajax({
        url: "/api/clientes",
        type: "POST",
        data: {
            fecha1: fecha1,
            fecha2: fecha2
        },
        success: function (response) {
            // Verificar si la respuesta no está vacía antes de analizarla
            if (response.success) {
                // Mostrar alerta de éxito utilizando SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: 'Cliente actualizado correctamente!',
                });
                // Aquí también puedes utilizar los datos de la respuesta, si es necesario
                // console.log(response.data);
                actualizarGrafico(response.data);
            } else {
                // Mostrar alerta de error utilizando SweetAlert2
                swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al actualizar los datos del cliente',
                });
            }
        }
    });
}

function actualizarGrafico(data) {
    // Obtener el contexto del gráfico
    const ctx = document.getElementById('grafico-clientes').getContext('2d');
    
    // Verificar si el gráfico ya está creado
    if (myChart) {
        // Si existe, destruir el gráfico anterior
        myChart.destroy();
    }
    console.log(data);
    const etiquetas = data.map(cliente => cliente.nombre);
    const datos = data.map(cliente => parseInt(cliente.cantidad, 10));
    console.log(etiquetas);
    //console.log(data.vendidos);
    // Crear un nuevo gráfico con los datos recibidos
    myChart = new Chart(ctx, {
        type: 'bar', // Tipo de gráfico (puedes cambiarlo según tus necesidades)
        data: {
            labels: etiquetas, // Reemplaza 'labels' con el nombre de tu propiedad de etiquetas
            datasets: [{
                label: 'Clientes que mas compran por fecha',
                data: datos, // Reemplaza 'data' con el nombre de tu propiedad de valores
                backgroundColor: [
                    '#ea580c',
                    '#84cc16',
                    '#22d3ee',
                    '#a855f7',
                    '#ef4444',
                    '#14b8a6',
                    '#db2777',
                    '#e11d48',
                    '#7e22ce'
                ]
            }]
        },
        options: {
            scale: {
                  ticks: {
                        precision: 0
                        }
                    
                  }
            },
                
        
    });
    
}

});
 
//   const grafica = document.querySelector('#grafico-clientes');

//   if(grafica){

//       obtenerDatos()
//       async function obtenerDatos(){
//             const url = '/api/clientes'
//             const respuesta = await fetch(url)
//             const resultado = await respuesta.json()

//             console.log(resultado);
      

//       const ctx = document.getElementById('grafico-clientes');
//       new Chart(ctx, {
//       type: 'bar',
//       data: {
//             labels: resultado.map(cliente => cliente.nombre),
//             datasets: [{
//             data: resultado.map(cliente => cliente.cantidad ),
//             backgroundColor: [
//                   '#ea580c',
//                   '#84cc16',
//                   '#22d3ee',
//                   '#a855f7',
//                   '#ef4444',
//                   '#14b8a6',
//                   '#db2777',
//                   '#e11d48',
//                   '#7e22ce'
//             ],
//             borderWidth: 1
//             }]
//       },
//       options: {
//             scales: {
//             y: {
//             beginAtZero: true
//             }
//             },
//             plugins: {
//                 legend: {
//                     display: false
//                 }
//               }
//       }
//       });
//       }
//   }

  
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
