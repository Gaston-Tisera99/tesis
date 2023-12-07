

(function(){    


        const selectCategoria = document.getElementById('categoria');
        const grafico = document.getElementById('grafico-producto');
        let graficoExistente = null;

        const idCategoriaSeleccionada = selectCategoria.value;
        filtrarYActualizarGrafico(idCategoriaSeleccionada);

        selectCategoria.addEventListener('change', function () {
        const idCategoriaSeleccionada = selectCategoria.value;
        console.log(idCategoriaSeleccionada);
          filtrarYActualizarGrafico(idCategoriaSeleccionada);
      });

      

      async function filtrarYActualizarGrafico(idCategoriaSeleccionada) {
        
        obtenerDatos();
        async function obtenerDatos(){
          
          if (graficoExistente) {
            graficoExistente.destroy(); // Destruir el gráfico existente
          }
            const url = '/api/productos'
            const respuesta = await fetch(url)
            const resultado = await respuesta.json()

            console.log(resultado);

           const datosFiltrados = resultado.filter(producto => producto.id_categoria === idCategoriaSeleccionada);

           const ctx = grafico;
           graficoExistente = new Chart(ctx, {    
            type: 'bar',
            data: {
              labels: datosFiltrados.map(producto => producto.nombre_producto),  
              datasets: [{
                data: datosFiltrados.map(producto => producto.vendidos),
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
              scales: {
                y: {
                  beginAtZero: true,
                  stepSize: 10, 
                }
              },
              plugins: {
                legend: {
                    display: false
                }
              }
            }
          });
        }

        
    }
    

  

})();

 