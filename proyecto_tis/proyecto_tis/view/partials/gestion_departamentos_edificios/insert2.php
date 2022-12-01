<?php
require('view\partials\gestion_departamentos_edificios\conexion.php');

$id_recibido= $_POST["id_departamento"];
$edificio_recibido= $_POST["id_edificio"];
$nombre_recibido= $_POST["nombre_departamento"];

$sql_e="SELECT id_edificio FROM edificios WHERE id_edificio='$edificio_recibido'";
$check_e= mysqli_query($conexion, $sql_e);

if(mysqli_num_rows($check_e)!=0){
    echo "true";
    $sql="INSERT INTO departamentos(id_departamento, id_edificio, nombre_departamento) VALUES('$id_recibido','$edificio_recibido','$nombre_recibido')";
    $resultado= mysqli_query($conexion, $sql);
}else{
    echo "Error, la organizacion o la comuna no son correctas, intente nuevamente";
}
?>