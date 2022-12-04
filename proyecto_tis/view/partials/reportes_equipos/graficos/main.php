<?php
require("conexion.php");
$q1 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . ";";

$q2 = "SELECT nombre_departamento, nombre_edificio, count(id_equipo) as cantidad_equipos, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
GROUP BY nombre_departamento, nombre_edificio;";

$q3 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND equipos.estado='en funcionamiento';";

$q4 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND equipos.estado='inactivo';";

$q5 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND equipos.estado='en mantencion';";

$q6 = "SELECT nombre_edificio, count(id_equipo) as cantidad_equipos, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
GROUP BY nombre_edificio;";

$q7 = "SELECT organizaciones.id, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
GROUP BY organizaciones.id;";


$r1 = mysqli_query($conexion, $q1);
$r2 = mysqli_query($conexion, $q2);
$r3 = mysqli_query($conexion, $q3);
$r4 = mysqli_query($conexion, $q4);
$r5 = mysqli_query($conexion, $q5);
$r6 = mysqli_query($conexion, $q6);
$r7 = mysqli_query($conexion, $q7);

$row1 = mysqli_fetch_assoc($r1);
$row3 = mysqli_fetch_assoc($r3);
$row4 = mysqli_fetch_assoc($r4);
$row5 = mysqli_fetch_assoc($r5);
$row7 = mysqli_fetch_assoc($r7);
?>
<div class="d-flex flex-column shadow container-lg border border-primary rounded my-2 justify-content-center">
    <h4 class="align-self-center my-3">Trazabilidad de Equipos</h4>
    <div class="d-flex flex-column container-lg border border-dark rounded my-2 justify-content-center">
        <h5 class="my-3">>Informacion general de equipos en la organizacion</h5>
        <div class="row">
            <div class="col">
                <p>Cantidad de Equipos presentes: <?php echo $row1["cantidad_equipos"]; ?> </p>
            </div>
            <div class="col">
                <p>Cantidad de Equipos En Mantencion: <?php echo $row5["cantidad_equipos"]; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Cantidad de Equipos Funcionando: <?php echo $row3["cantidad_equipos"]; ?> </p>
            </div>
            <div class="col">
                <p>Monto invertido en Equipos: $<?php echo $row7["cantidad_monto"]; ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Cantidad de Equipos Inactivos: <?php echo $row4["cantidad_equipos"]; ?> </p>
            </div>
        </div>
        <div class=" graph_container col-4 d-inline align-self-center">
            <?php
            //Estado del equipo
            $funcionando = $row3["cantidad_equipos"];
            $mantencion = $row5["cantidad_equipos"];
            $inactivos = $row4["cantidad_equipos"];

            //Cantidad de revisiones
            //array -> 0 cantRevisiones, cantEquipos

            $_SESSION['funcionando'] = $funcionando;
            $_SESSION['mantencion'] = $mantencion;
            $_SESSION['inactivos'] = $inactivos;

            require_once "view/partials/reportes_equipos/graficos/chart.php";
            ?>
        </div>
        <h5 class="mt-3">>Cantidad de equipos y costos totales por departamento</h5>
        <div class="overflow-auto h-25 d-flex flex-column container-lg border border-dark rounded my-2 justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Departamento</th>
                        <th scope="col">Edificio</th>
                        <th scope="col">Cantidad de Equipos</th>
                        <th scope="col">Monto Inveritdo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row2 = mysqli_fetch_assoc($r2)) {
                        echo "<tr>
                                <td>" . $row2["nombre_departamento"] . "</td>
                                <td>" . $row2["nombre_edificio"] . "</td>
                                <td>" . $row2["cantidad_equipos"] . "</td>
                                <td>$" . $row2["cantidad_monto"] . "</td>
                        </tr>";
                    } ?>
                </tbody>
            </table>
        </div>
        <h5 class="mt-3">>Cantidad de equipos y costos totales por edificio</h5>
        <div class="overflow-auto h-25 d-flex flex-column container-lg border border-dark rounded my-2 justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Edificio</th>
                        <th scope="col">Cantidad de Equipos</th>
                        <th scope="col">Monto Inveritdo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row6 = mysqli_fetch_assoc($r6)) {
                        echo "<tr>
                                <td>" . $row6["nombre_edificio"] . "</td>
                                <td>" . $row6["cantidad_equipos"] . "</td>
                                <td>$" . $row6["cantidad_monto"] . "</td>
                        </tr>";
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>