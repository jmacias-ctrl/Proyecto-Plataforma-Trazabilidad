<?php
require("connect.php");

$id_consultado= $_GET["id_departamento"];

$sql="DELETE FROM departamentos WHERE id_departamento='$id_consultado'";
$resultado= mysqli_query($conexion, $sql);

header('location: index.php');
?>