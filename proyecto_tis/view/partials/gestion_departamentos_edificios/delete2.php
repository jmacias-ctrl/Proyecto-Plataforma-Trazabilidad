<?php
require('view\partials\gestion_departamentos_edificios\conexion.php');

$id_consultado= $_GET["id_departamento"];

$sql="DELETE FROM departamentos WHERE id_departamento='$id_consultado'";
$resultado= mysqli_query($conexion, $sql);

?>