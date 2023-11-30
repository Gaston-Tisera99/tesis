

    

<?php include_once __DIR__ .'/../templates/header.php' ?>
<h1>GRAFICO DE PRODUCTOS POR CATEGORIA</h1>
        <div class="container">
            <div class="col-md-3">
                  <label for="productos">Seleccione Una Categoria</label>
                  <div class="input-group">
                          <select class="form-control" id="categoria" name="categoriaid">
                              
                              <?php foreach($categorias as $categoria){?> 
                              <option 
                                  <?php echo $producto->categoriaid === $categoria->id ? 'selected' : ''; ?>
                                  value="<?php echo s($categoria->id); ?>"><?php echo s($categoria->nombre); ?></option>
                              <?php }?>  
                          </select>
                  </div>
              </div>
        </div>
              
             
<div>
    <div class="dashboard__grafica chart-container">
        <canvas id="grafico-producto" width="400" height="400"></canvas>
  </div>
</div>

<?php
     $script = "
     <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>                        
        <script src='build/js/reporte.js'></script>

     ";     
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 





