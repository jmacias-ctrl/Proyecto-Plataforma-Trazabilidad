<?php
require('view\partials\gestion_equipos_componentes\conexion.php');
if (isset($_POST['deletedata'])) {
    $id_equipo = $_POST['delete_id'];
    $query = "DELETE FROM equipos WHERE id_equipo=".$id_equipo.";";
    $resultado = mysqli_query($conexion, $query);
}
