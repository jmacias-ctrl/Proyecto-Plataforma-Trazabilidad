<?php
require($_SERVER['DOCUMENT_ROOT'] . '/xampp/proyecto_tis/conexion.php');
$q1 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . ";";

$q2 = "SELECT nombre_departamento, nombre_edificio, count(id_equipo) as cantidad_equipos, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
GROUP BY nombre_departamento, nombre_edificio;";

$q3 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
            AND equipos.estado='Funcionando';";

$q4 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
            AND equipos.estado='Inactivo';";

$q5 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
            AND equipos.estado='En mantencion';";

$q6 = "SELECT nombre_edificio, count(id_equipo) as cantidad_equipos, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
GROUP BY nombre_edificio;";

$q7 = "SELECT organizaciones.id, sum(COSTO_ADQUISICION) as cantidad_monto FROM equipos LEFT JOIN departamentos using(id_departamento) LEFT JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
GROUP BY organizaciones.id;";

$q8 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
            AND datediff(current_date(), fecha_adquisicion)/365<=1;";

$q9 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
            AND datediff(current_date(), fecha_adquisicion)/365>1
            AND datediff(current_date(), fecha_adquisicion)/365<4;";

$q10 = "SELECT count(id_equipo) as cantidad_equipos FROM equipos LEFT JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones = organizaciones.id)
            WHERE organizaciones.id=" . $_GET['id_organizacion'] . "
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
ob_start();
?>
<html>

<head>
    <meta name="description" content="-">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/jpg" href="view\public\images\heritech\logo\heritech_logo_white.png" />
    <link rel="stylesheet" href="view/public/css/buttonStyle.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<div>
    <div class="d-flex flex-column shadow container-lg my-2 justify-content-center">
        <h4 class="align-self-center">Trazabilidad de Equipos</h4>
        <div class="d-flex flex-column container-lg justify-content-center">
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
            <div class=" graph_container my-3 col-4 d-inline align-self-center">
                <?php
                //Estado del equipo
                $funcionando = $row3["cantidad_equipos"];
                $mantencion = $row5["cantidad_equipos"];
                $inactivos = $row4["cantidad_equipos"];
                ?>
                <?php
                echo "<img style=\"height:280px\" src=\"https://quickchart.io/chart?c={type:'pie',data:{labels:['Funcionando','Mantencion','Inactivo'],datasets:[{label:'Cantidad',data:[$funcionando,$mantencion,$inactivos]}]}}\">";
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

                ?>
                <div>
                    <?php
                    echo "<img style=\"height:300px\" src=\"https://quickchart.io/chart?c={type:'bar',data:{labels:['x<=1 años','1<x<3 años','x>=3 años'],datasets:[{label:'Años',data:[$anio_menor_1,$anio_mayor_1,$anio_mayor_3]}]}}\">";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<?php
if (isset($_POST['pdfDownload'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/xampp/proyecto_tis/dompdf/autoload.inc.php';
    $pdf = new Dompdf\DOMPDF();

    $options = $pdf->getOptions();
    $options->set(array('isRemoteEnabled' => true));

    $html = ob_get_clean();

    $pdf->loadHtml($html);

    $pdf->setPaper('letter');
    $pdf->render();
    $f;
    $l;

    $pdf->stream("archivo_pdf", array("Attachment" => false));
}
