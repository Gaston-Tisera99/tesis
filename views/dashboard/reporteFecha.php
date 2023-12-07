<?php include_once __DIR__ .'/../templates/header.php' ?>
<h1>PRODUCTOS MAS VENDIDOS POR FECHA</h1>
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
                        <button type="button" class="btn btn-raised btn-success btn-xs" id="buscar" name="buscar">BUSCAR</button>
                    </div>
                </div>
            </form>
        </div>
                   
<div>
    <div class="dashboard__grafica chart-container">
        <canvas id="grafico-fecha" width="400" height="400"></canvas>
  </div>
</div>

<?php
     $script = "
     <script src='build/js/reporteFecha.js'></script>
     <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>                        
     ";     
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
