<?php
require('view\partials\gestion_equipos_componentes\conexion.php');
$q1 = "SELECT componentes.*, count(componentes.estado) as cantidad_componente FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . "
AND componentes.estado = 'en uso';";
$q2 = "SELECT componentes.*, count(componentes.estado) as cantidad_componente FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . "
AND componentes.estado = 'en bodega';";
$q3 = "SELECT componentes.*, count(componentes.estado) as cantidad_componente FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . "
AND componentes.estado = 'mal estado';";

$q4 = "SELECT count(id_componente) as cantidad_componente FROM procesadores LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . ";";

$q5 = "SELECT count(id_componente) as cantidad_componente FROM placa_base LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . ";";

$q6 = "SELECT count(id_componente) as cantidad_componente FROM memorias_ram LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . ";";

$q7 = "SELECT count(id_componente) as cantidad_componente FROM discos_internos LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . ";";

$r1 = mysqli_query($conexion, $q1);
$r2 = mysqli_query($conexion, $q2);
$r3 = mysqli_query($conexion, $q3);
$r4 = mysqli_query($conexion, $q4);
$r5 = mysqli_query($conexion, $q5);
$r6 = mysqli_query($conexion, $q6);
$r7 = mysqli_query($conexion, $q7);

$row1 = mysqli_fetch_assoc($r1);
$row2 = mysqli_fetch_assoc($r2);
$row3 = mysqli_fetch_assoc($r3);
$row4 = mysqli_fetch_assoc($r4);
$row5 = mysqli_fetch_assoc($r5);
$row6 = mysqli_fetch_assoc($r6);
$row7 = mysqli_fetch_assoc($r7);
?>
<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Trazabilidad de Componentes</h1>
        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
                    <div class="container aling-self-center">
                        <div class="row row-cols-auto d-flex align-items-center">
                            <div class="col-5">
                                <h5>Cantidad de Componentes:</h5>
                                <ul class="list-group">
                                    <li class="list-group-item">En uso: <?php echo $row1["cantidad_componente"]; ?> </li>
                                    <li class="list-group-item">En bodega: <?php echo $row2["cantidad_componente"]; ?> </li>
                                    <li class="list-group-item">En mal estado: <?php echo $row3["cantidad_componente"]; ?> </li>
                                    <li class="list-group-item">Total: <?php echo $row1["cantidad_componente"] + $row2["cantidad_componente"] + $row3["cantidad_componente"]; ?> </li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <div class="col">
                                    <ul class="list-group">
                                        <li class="list-group-item">Cantidad de Procesadores: <?php echo $row4["cantidad_componente"]; ?> </li>
                                        <li class="list-group-item">Cantidad de Memorias Ram: <?php echo $row6["cantidad_componente"]; ?> </li>
                                        <li class="list-group-item">Cantidad de Placas Base: <?php echo $row5["cantidad_componente"]; ?> </li>
                                        <li class="list-group-item">Cantidad de Discos Internos: <?php echo $row7["cantidad_componente"]; ?> </li>
                                        <li class="list-group-item">Cantidad de Otros Componentes: <?php echo ($row1["cantidad_componente"] + $row2["cantidad_componente"] + $row3["cantidad_componente"]) - ($row4["cantidad_componente"] + $row6["cantidad_componente"] + $row5["cantidad_componente"] + $row7["cantidad_componente"]); ?> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-xl d-flex flex-column border border-primary rounded">
                    <div class="align-self-center">
                        <h4 class="my-4 ">Listado de Componentes</h4>
                        <div class="table-responsive caption-top">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Ver</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nombre Componente</th>
                                        <th scope="col">Id Equipo</th>
                                        <th scope="col">Nombre Equipo</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Modelo</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
                                    WHERE organizaciones.id =" . $_SESSION["id_organizacion"] . ";";
                                    $resultado = mysqli_query($conexion, $query);
                                    while ($row = mysqli_fetch_assoc($resultado)) {
                                        $id = $row['ID_COMPONENTE'];
                                        $id_equipo = $row['ID_EQUIPO'];
                                        $nombre = $row["NOMBRE"];
                                        $marca = $row["MARCA"];
                                        $modelo = $row["MODELO"];

                                        $q1 = "SELECT nombre_equipo FROM equipos WHERE id_equipo=" . $id_equipo . ";";
                                        $r1 = mysqli_query($conexion, $q1);
                                        $row2 = mysqli_fetch_assoc($r1);

                                        echo '<tr>';
                                        echo '<td><a class="btn btn-outline-info" href="prueba.php?p=gestion_equipos_componentes/componentes/reporte_componente&id=' . $id . '&id_equipo=' . $id_equipo . '" role="button"><span class="material-symbols-outlined">info</span> </a></td>';
                                        echo '<td>' . $id . '</td>';
                                        echo '<td>' . $nombre . '</td>';
                                        echo '<td>' . $id_equipo . '</td>';
                                        echo '<td>' . $row2['nombre_equipo'] . '</td>';
                                        echo '<td>' . $marca . '</td>';
                                        echo '<td>' . $modelo . '</td>';
                                        echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-icons">delete</span></button></button> </td>';
                                        echo '<td> <button type="button" class="btn btn-outline-primary"><span class="material-icons">edit</span> </button> </td>';
                                        echo '</tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>