<?php
$q3 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND equipos.estado='Funcionando';";

$q4 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND equipos.estado='Inactivo';";

$q5 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND equipos.estado='En mantencion';";

$q6 = "SELECT nombre_edificio, count(id_equipo) as cantidad_equipos, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            GROUP BY nombre_edificio;";

$r3 = mysqli_query($conexion, $q3);
$r4 = mysqli_query($conexion, $q4);
$r5 = mysqli_query($conexion, $q5);
$r6 = mysqli_query($conexion, $q6);

$row3 = mysqli_fetch_assoc($r3);
$row4 = mysqli_fetch_assoc($r4);
$row5 = mysqli_fetch_assoc($r5);
?>
<title>Inicio</title>
<center>
    <div>
        <center>
            <br>
            <H1>Bienvenido: <?php echo $_SESSION['correo'] ?> <br> <?php echo $_SESSION['nombre_usuario'] ?></H1>
            <h3>Este es un resumen de tus equipamientos electronicos</h3>
        </center>
        <br>
        <div class="d-flex flex-column shadow container-lg border border-primary rounded my-2 justify-content-center">
            <h5 class="my-3">>Cantidad de Equipos por su estado</h5>
            <div class=" graph_container col-5 d-inline align-self-center">
                <?php
                //Estado del equipo
                $funcionando = $row3["cantidad_equipos"];
                $mantencion = $row5["cantidad_equipos"];
                $inactivos = $row4["cantidad_equipos"];

                $_SESSION['funcionando'] = $funcionando;
                $_SESSION['mantencion'] = $mantencion;
                $_SESSION['inactivos'] = $inactivos;
                require_once "view/partials/reportes_equipos/graficos/chart.php";
                ?>
            </div>
            <h5 class="mt-5">>Equipos en Mantencion</h5>
            <div class="table-responsive caption-top overflow-auto">
                <table class="table" id="infoGestion">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre del Equipo</th>
                            <th scope="col">Edificio</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Mantenedor</th>
                            <th scope="col">Nombre Mantencion</th>
                            <th scope="col">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT equipos.*, nombre_edificio, nombre_departamento FROM equipos, edificios, departamentos, organizaciones WHERE equipos.id_departamento = departamentos.id_departamento 
                        AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . " AND estado = 'En mantencion';";
                        $resultado = mysqli_query($conexion, $query);
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $id = $row['ID_EQUIPO'];
                            $nombre = $row["NOMBRE_EQUIPO"];
                            $nombreEdificio = $row["nombre_edificio"];
                            $nombreDepartamento = $row["nombre_departamento"];
                            $query2 = "SELECT nombre_mantencion, fecha_mantencion, mantenedores.nombre FROM mantenciones JOIN realiza using(id_mantencion) JOIN mantenedores using(rut)
                            WHERE id_equipo = $id;";
                            $resultado2 = mysqli_query($conexion, $query2);
                            $row2 = mysqli_fetch_assoc($resultado2);
                            echo '<tr>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $nombre . '</td>';
                            echo '<td>' . $nombreEdificio . '</td>';
                            echo '<td>' . $nombreDepartamento . '</td>';
                            echo '<td>' . $row2['nombre'] . '</td>';
                            echo '<td>' . $row2['nombre_mantencion'] . '</td>';
                            echo '<td>' . $row2['fecha_mantencion'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <h5 class="mt-5">>Cantidad de equipos por edificio</h5>
                <div class="overflow-auto h-25 d-flex flex-column container-lg border border-dark rounded my-2 justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Edificio</th>
                                <th scope="col">Cantidad Total de Equipos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row6 = mysqli_fetch_assoc($r6)) {
                                echo "<tr>
                                    <td>" . $row6["nombre_edificio"] . "</td>
                                    <td>" . $row6["cantidad_equipos"] . "</td>
                            </tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</center>

<div class="divplus">

    <div class="presentation">
    </div>
</div>