
<?php

$conexion=mysqli_connect('localhost','root','27deagosto','appmito');
$categoria=$_POST['categoria'];



$sql="SELECT id, codigo, nombre, precio from producto where categoriaid = $categoria";

$result=mysqli_query($conexion,$sql);
    
	$cadena="
    
            <label>Elegir Producto: </label> 
            <select class='form-control' id='lista2' name='lista2'>
            <option selected value='' disabled>-- Seleccione --</option>
            ";
          
            while ($ver=mysqli_fetch_row($result)) {
                $cadena = $cadena . '<option value=' . $ver[1] . ' id-producto=' . $ver[0]. ''.' data-precio="' . $ver[3] . '">' . $ver[2] . '</option>';
                
            }   
            echo  $cadena."</select>";
           
            //debuguear($ver);
?>



