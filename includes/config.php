<?php
    $host = "localhost";
    $username = "root";
    $password = "27deagosto";
    $database = "appmito";


$conn = new mysqli($host, $username, $password, $database);
if($conn->connect_errno){
    die("Error en la conexion: " .$conn->connect_error);
}   

?>