<?php
require("connect.php");

$id_recibido= $_GET["id_departamento"];
$edificio_recibido= $_POST["id_edificio"];
$nombre_recibido= $_POST["nombre_departamento"];

$sql_e="SELECT id_edificio FROM edificios WHERE id_edificio='$edificio_recibido';";
$check_e= mysqli_query($conexion, $sql_e);

if(mysqli_num_rows($check_e)!=0){
    echo "true";
    $sql="UPDATE departamentos SET id_departamento='".$id_recibido."', id_edificio='".$edificio_recibido."' , nombre_departamento='".$nombre_recibido."' WHERE id_departamento='".$id_recibido."';";
    $resultado= mysqli_query($conexion, $sql);
}else{
    echo "Error, intente nuevamente";
}


header('location: index.php');
?>