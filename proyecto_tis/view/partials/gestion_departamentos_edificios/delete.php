<?php
require('view\partials\gestion_departamentos_edificios\conexion.php');

$id_consultado= $_GET["id"];

$sql="DELETE FROM edificios WHERE id_edificio='$id_consultado'";
$resultado= mysqli_query($conexion, $sql);

?>