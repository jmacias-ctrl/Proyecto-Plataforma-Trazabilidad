<?php
    require('view\partials\gestion_equipos_componentes\conexion.php');

    $idComponente = $_POST["delete_id"];

    $query = "DELETE FROM componentes WHERE id_componente=".$idComponente.";";
    $resultado = mysqli_query($conexion, $query);