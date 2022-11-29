<?php
    require('view\partials\gestion_equipos_componentes\conexion.php');

    $rut_funcionario = $_POST["rut_funcionario"];

    $query = "DELETE FROM `funcionarios` WHERE rut_funcionario = $rut_funcionario";
    $resultado = mysqli_query($conexion, $query);

    // header("Location: http://localhost/index.php?p=/modules/databases/kcalendar");
?>