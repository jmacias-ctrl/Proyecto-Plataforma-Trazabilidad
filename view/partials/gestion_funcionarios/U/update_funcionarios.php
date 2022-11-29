<?php
    require('view\partials\gestion_equipos_componentes\conexion.php');

    $rut_funcionario = $_POST["rut_funcionario"];
    $nombre_funcionario = $_POST["nombre_funcionario"];
    $tipo_funcionario = $_POST["tipo"];

    $query = "UPDATE `funcionarios`
    SET NOMBRE_FUNCIONARIO=".$nombre_funcionario.", tipo=".$tipo_funcionario."WHERE rut_funcionario =".$rut_funcionario.";";

    $resultado = mysqli_query($conexion, $query);

    //UPDATE `funcionarios` SET `RUT_FUNCIONARIO`='[value-1]',`NOMBRE_FUNCIONARIO`='[value-2]',`TIPO`='[value-3]' WHERE 1
    // header("Location: http://localhost/index.php?p=/modules/databases/kcalendar");
