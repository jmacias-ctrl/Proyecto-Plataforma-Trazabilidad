<?php
require($_SERVER['DOCUMENT_ROOT'] . '/xampp/proyecto_tis/conexion.php');
$q1 = "SELECT componentes.*, count(componentes.estado) as cantidad_componente FROM componentes LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_GET['id_organizacion'] . "
AND componentes.estado = 'en uso';";
$q2 = "SELECT componentes.*, count(componentes.estado) as cantidad_componente FROM componentes WHERE componentes.estado = 'en bodega';";

$q3 = "SELECT componentes.*, count(componentes.estado) as cantidad_componente FROM componentes WHERE componentes.estado = 'mal estado';";

$q4 = "SELECT count(id_componente) as cantidad_componente FROM procesadores LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_GET['id_organizacion'] . ";";

$q5 = "SELECT count(id_componente) as cantidad_componente FROM placa_base LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_GET['id_organizacion'] . ";";

$q6 = "SELECT count(id_componente) as cantidad_componente FROM memorias_ram LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_GET['id_organizacion'] . ";";

$q7 = "SELECT count(id_componente) as cantidad_componente FROM discos_internos LEFT JOIN componentes using(id_componente) LEFT JOIN equipos using(id_equipo) JOIN departamentos using(id_departamento) JOIN edificios using(id_edificio) JOIN organizaciones on(edificios.id_organizaciones=organizaciones.id)  
WHERE organizaciones.id =" . $_GET['id_organizacion'] . ";";

$q8 = "SELECT count(id_componente)  as cantidad_componentes FROM componentes WHERE cantidad_usos<=5";

$q9 = "SELECT count(id_componente) as cantidad_componentes  FROM componentes WHERE cantidad_usos>5 AND cantidad_usos<10";

$q10 = "SELECT count(id_componente) as cantidad_componentes FROM componentes WHERE cantidad_usos>=10";

$q11 = "SELECT id_componente, nombre FROM componentes WHERE estado='mal estado'";

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
$r11 = mysqli_query($conexion, $q11);

$row1 = mysqli_fetch_assoc($r1);
$row2 = mysqli_fetch_assoc($r2);
$row3 = mysqli_fetch_assoc($r3);
$row4 = mysqli_fetch_assoc($r4);
$row5 = mysqli_fetch_assoc($r5);
$row6 = mysqli_fetch_assoc($r6);
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

<div class="container-sm align-items-center">
    <div class="d-flex flex-column shadow container-lg  my-2 justify-content-center">
        <h4 class="align-self-center my-3">Trazabilidad de Componentes</h4>
        <div class="d-flex flex-column container-lg  my-2 justify-content-center">
            <h5 class="my-3">>Cantidad de Componentes:</h5>
            <div class="row">
                <div class="col">
                    <ul class="list-group">
                        <li class="list-group-item">En uso: <?php echo $row1["cantidad_componente"]; ?> </li>
                        <li class="list-group-item">En bodega: <?php echo $row2["cantidad_componente"]; ?> </li>
                        <li class="list-group-item">En mal estado: <?php echo $row3["cantidad_componente"]; ?> </li>
                        <li class="list-group-item">Total: <?php echo $row1["cantidad_componente"] + $row2["cantidad_componente"] + $row3["cantidad_componente"]; ?> </li>
                    </ul>
                </div>
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
            <div class="row my-4">
                <div class="col-4">
                    <div class=" graph_container col-4 d-inline align-self-center">
                        <?php
                        //Estado del equipo
                        $enUso = $row1["cantidad_componente"];
                        $enBodega = $row2["cantidad_componente"];
                        $MalEstado = $row3["cantidad_componente"];


                        ?>
                        <?php
                        echo "<img style=\"height:280px\" src=\"https://quickchart.io/chart?c={type:'pie',data:{labels:['En Uso','En Bodega','Mal Estado'],datasets:[{label:'Cantidad',data:[$enUso, $enBodega, $MalEstado]}]}}\">";
                        ?>
                    </div>
                </div>
                <div class="col">
                    <div class=" graph_container col-4 d-inline align-self-center">
                        <?php
                        //Estado del equipo
                        $cRam = $row6["cantidad_componente"];
                        $cDiscos = $row7["cantidad_componente"];
                        $cPB = $row5["cantidad_componente"];
                        $cCPU = $row4["cantidad_componente"];
                        $cOtros = ($row1["cantidad_componente"] + $row2["cantidad_componente"] + $row3["cantidad_componente"]) - ($row4["cantidad_componente"] + $row6["cantidad_componente"] + $row5["cantidad_componente"] + $row7["cantidad_componente"]);
                        ?>
                        <?php
                        echo "<img style=\"height:230px\" src=\"https://quickchart.io/chart?c={type:'bar',data:{labels:['Memorias Ram','Discos Internos','CPU','Placa Base','Otros'],datasets:[{label:'Cantidad',data:[$cRam,$cDiscos,$cPB,$cCPU,$cOtros]}]}}\">";
                        ?>
                    </div>
                </div>
            </div>
            <h5 class="my-5">>Cantidad de transferencias de equipos del componente</h5>
            <div class=" graph_container col-6 d-inline align-self-center">
                <?php
                $uso_menor_5 = $row8["cantidad_componentes"];
                $uso_mayor_5 = $row9["cantidad_componentes"];
                $uso_mayor_10 = $row10["cantidad_componentes"];
                ?>
                <?php
                echo "<img style=\"height:250px\" src=\"https://quickchart.io/chart?c={type:'bar',data:{labels:['x>=5','5<x<10','x>=10'],datasets:[{label:'Cantidad Usos',data:[$uso_menor_5, $uso_mayor_5, $uso_mayor_10]}]}}\">";
                ?>
            </div>
            <h5 class="my-3">>Componentes en Mal estado</h5>
            <div class="overflow-auto h-25 d-flex flex-column container-lg border border-dark rounded my-2 justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID Componente</th>
                            <th scope="col">Nombre Componente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row11 = mysqli_fetch_assoc($r11)) {
                            echo "<tr>
                                    <td>" . $row11["id_componente"] . "</td>
                                    <td>" . $row11["nombre"] . "</td>
                            </tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</div>

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
