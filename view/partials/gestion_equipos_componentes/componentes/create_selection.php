<?php
require('../conexion.php');
session_start();
$_SESSION["id_equipo"] = $_POST["idEquipo"];
$_SESSION["nComponente"]  = strval($_POST["nComponente"]);
$_SESSION["mComponente"]  = strval($_POST["mComponente"]);
$_SESSION["modComponente"] = strval($_POST["modComponente"]);
$_SESSION["selectComponente"]  = $_POST["selectComponente"];

if ($_SESSION["selectComponente"] == "form2") {
    header("Location: ../componentes/create_procesador.php");
} else if ($_SESSION["selectComponente"] == "form3") {
    header("Location: ../componentes/create_pb.php");
} else if ($_SESSION["selectComponente"]== "form4") {
    header("Location: ../componentes/create_ram.php");
} else if ($_SESSION["selectComponente"] == "form5") {
    header("Location: ../componentes/create_disco.php");
} else {
    $query = "INSERT INTO componentes
        VALUES (DEFAULT,'$id_equipo', '$nComponente', '$mComponente', '$modComponente')";
    $resultado = mysqli_query($conexion, $query);
}
