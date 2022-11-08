<?php
require("connect.php");

$id_consultado= $_GET["id"];

$sql="DELETE FROM edificios WHERE id_edificio='$id_consultado'";
$resultado= mysqli_query($conexion, $sql);

header('location: index.php');
?>