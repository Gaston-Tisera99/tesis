$(document).ready(function () {

    let myChart;

    $('#buscar').on('click', function () {
        enviarFecha();
    });

    function enviarFecha() {
        const fecha1 = document.getElementById('fechaDesde').value;
        const fecha2 = document.getElementById('fechaHasta').value;

        $.ajax({
            url: "/api/grafico-fecha",
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
        const ctx = document.getElementById('grafico-fecha').getContext('2d');
        
        // Verificar si el gráfico ya está creado
        if (myChart) {
            // Si existe, destruir el gráfico anterior
            myChart.destroy();
        }
        console.log(data);
        const etiquetas = data.map(item => item.nombre_producto);
        const datos = data.map(item => parseInt(item.vendidos, 10));
        console.log(etiquetas);
        console.log(data.vendidos);
        // Crear un nuevo gráfico con los datos recibidos
        myChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico (puedes cambiarlo según tus necesidades)
            data: {
                labels: etiquetas, // Reemplaza 'labels' con el nombre de tu propiedad de etiquetas
                datasets: [{
                    label: 'LOS 10 PRODUCTOS MAS VENDIDOS',
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
            }
            
        });
        
    }
    
});

