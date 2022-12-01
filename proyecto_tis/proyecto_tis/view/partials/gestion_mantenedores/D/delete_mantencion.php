<?php
    require('view\partials\gestion_equipos_componentes\conexion.php');

    $id = $_GET["rut"];

    $query = "DELETE FROM `mantenciones` WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    // header("Location: http://localhost/index.php?p=/modules/databases/kcalendar");
?>