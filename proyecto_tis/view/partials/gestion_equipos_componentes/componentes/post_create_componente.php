<?php
require('../conexion.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
 }
$id_equipo = $_SESSION["id_equipo"];
$nComponente = $_SESSION["nComponente"];
$mComponente = $_SESSION["mComponente"];
$modComponente = $_SESSION["modComponente"];
$selectComponente = $_SESSION["selectComponente"];

$query = "INSERT INTO componentes
        VALUES (DEFAULT,'$id_equipo', '$nComponente', '$mComponente', '$modComponente')";
$query2;
switch ($selectComponente) {
    case 'form2':
        $cpuNucleo = $_POST["cpuNucleo"];
        $cpuSocket = $_POST["cpuSocket"];
        $cpuRelojBase = $_POST["cpuRelojBase"];
        $cpuHilos = $_POST["cpuHilos"];
        
        $query2 = "INSERT INTO procesadores
                    VALUES (DEFAULT,'$cpuNucleo', '$cpuSocket', '$cpuRelojBase', '$cpuHilos')";
        break;
    case 'form3':
        $factorFormaPB = $_POST["factorFormaPB"];
        $pbSocket = $_POST["pbSocket"];
        $soporteMemoria = $_POST["soporteMemoria"];
        $pbCaracteristicas = $_POST["pbCaracteristicas"];

        $query2 = "INSERT INTO memorias_ram
                    VALUES (DEFAULT,'$factorFormaPB', '$pbSocket', '$soporteMemoria', '$pbCaracteristicas')";
        break;
    case 'form4':
        $ramMemoria = $_POST["ramMemoria"];
        $ramTecnologia = $_POST["ramTecnologia"];
        $ramVelocidadFrequencia = $_POST["ramVelocidadFrequencia"];
        $query2 = "INSERT INTO memorias_ram
                    VALUES (DEFAULT,'$ramVelocidadFrequencia', '$ramMemoria', '$ramTecnologia')";
        break;
    case 'form5':
        $discoCapacidad = $_POST["discoCapacidad"];
        $idDisco = $_POST["idDisco"];
        $query2 = "INSERT INTO discos_internos
                    VALUES (DEFAULT,'$discoCapacidad', '$idDisco')";
        break;
}
$resultado = mysqli_query($conexion, $query);
$resultado = mysqli_query($conexion, $query2);
header("Location: ../../../../prueba.php");