<?php include_once __DIR__ .'/../templates/header.php' ?>
<h1>GRAFICO DE CLIENTES</h1>
<div>
      <div class="dashboard__grafica chart-container">
            <canvas id="grafico-clientes" width="400" height="400"></canvas>
      </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
 
  const grafica = document.querySelector('#grafico-clientes');

  if(grafica){

      obtenerDatos()
      async function obtenerDatos(){
            const url = '/api/clientes'
            const respuesta = await fetch(url)
            const resultado = await respuesta.json()

            console.log(resultado);
      

      const ctx = document.getElementById('grafico-clientes');
      new Chart(ctx, {
      type: 'bar',
      data: {
            labels: resultado.map(cliente => cliente.nombre),
            datasets: [{
            data: resultado.map(cliente => cliente.cantidad ),
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
            ],
            borderWidth: 1
            }]
      },
      options: {
            scales: {
            y: {
            beginAtZero: true
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

  
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
