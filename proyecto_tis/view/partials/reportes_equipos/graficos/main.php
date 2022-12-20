<?php
require("conexion.php");
$q1 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . ";";

$q2 = "SELECT nombre_departamento, nombre_edificio, count(id_equipo) as cantidad_equipos, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
GROUP BY nombre_departamento, nombre_edificio;";

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

$q7 = "SELECT organizaciones.id, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
GROUP BY organizaciones.id;";

$q8 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND datediff(current_date(), fecha_adquisicion)/365<=1;";

$q9 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND datediff(current_date(), fecha_adquisicion)/365>1
            AND datediff(current_date(), fecha_adquisicion)/365<4;";

$q10 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_SESSION["id_organizacion"] . "
            AND datediff(current_date(), fecha_adquisicion)/365>=4;";

$r1 = mysqli_query($conexion, $q1);
$r2 = mysqli_query($conexion, $q2);
$r3 = mysqli_query($conexion, $q3);
$r4 = mysqli_query($conexion, $q4);
$r5 = mysqli_query($conexion, $q5);
$r6 = mysqli_query($conexion, $q6);
$r7 = mysqli_query($conexion, $q7);
$r8 = mysqli_query($conexion, $q8);
$r9 = mysqli_query($conexion, $q9);
$r10 = mysqli_query($conexion, $q10);

$row1 = mysqli_fetch_assoc($r1);
$row3 = mysqli_fetch_assoc($r3);
$row4 = mysqli_fetch_assoc($r4);
$row5 = mysqli_fetch_assoc($r5);
$row7 = mysqli_fetch_assoc($r7);
$row8 = mysqli_fetch_assoc($r8);
$row9 = mysqli_fetch_assoc($r9);
$row10 = mysqli_fetch_assoc($r10);
?>
<title>Trazabilidad de Equipos</title>
<div>
    <div class="d-flex flex-column shadow container-lg border border-primary rounded my-2 justify-content-center">
        <h4 class="align-self-center my-3">Trazabilidad de Equipos</h4>
        <form action="view\partials\reportes_equipos/graficos/generarPDFEquipos.php?id_organizacion=<?php print $_SESSION["id_organizacion"] ?>" method="post">
            <input type="submit" class="btn btn-danger align-self-end" name="pdfDownload" value="Descargar PDF" />
        </form>
        <div class="d-flex flex-column container-lg border border-dark rounded my-2 justify-content-center">
            <h5 class="my-3">>Informacion general de equipos en la organizacion</h5>
            <div class="row">
                <div class="col">
                    <p>Cantidad de Equipos Presentes: <?php echo $row1["cantidad_equipos"]; ?> </p>
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
                            <th scope="col">Monto Invertido</th>
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
            <h5 class="mt-3">>Antiguedad de los Equipos en dias</h5>
            <div class=" graph_container col-6 d-inline align-self-center">
                <?php
                $anio_menor_1 = $row8["cantidad_equipos"];
                $anio_mayor_1 = $row9["cantidad_equipos"];
                $anio_mayor_3 = $row10["cantidad_equipos"];

                $_SESSION['anio_menor_1'] = $anio_menor_1;
                $_SESSION['anio_mayor_1'] = $anio_mayor_1;
                $_SESSION['anio_mayor_3'] = $anio_mayor_3;

                require_once "view/partials/reportes_equipos/graficos/chart2.php";
                ?>
            </div>
        </div>

    </div>
</div>