<?php
//bd-user-pass-id
include('conexion.php');
// aca estaba el conect.php
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title> Visualizar equipos </title>
    <meta charset="utf-8">
    <!--link rel="stylesheet" href="test1-2022.css"-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <br>

    <div class="container-xxl d-flex flex-column border border-primary rounded">
        <div class="align-self-center">
            <h1 class="my-3">Reportes de todos los equipos</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id equipo</th>
                    <th>Nombre del Departamento</th>
                    <th>Nombre del Edificio</th>
                    <th>Funcionario utilizando el equipo</th>
                    <th>Nombre del equipo</th>
                    <th>Fecha de adquisicion</th>
                    <th>Costa de adquisicion</th>
                    <th>Forma adquisicion</th>
                    <th>Caracteristicas de adquisicion</th>
                    <th>Estado del Equipo</th>
                    <th>Cantidad de mantenciones realizadas</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql_e = "SELECT equipos.* FROM equipos, edificios, departamentos, organizaciones WHERE equipos.id_departamento = departamentos.id_departamento 
                AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . ";";
                $check_e = mysqli_query($conexion, $sql_e);

                if (mysqli_num_rows($check_e) != 0) {
                    while ($row = mysqli_fetch_assoc($check_e)) {
                        $id_consultado = $row["ID_EQUIPO"];
                        $departamento_consultado = $row["ID_DEPARTAMENTO"];
                        $rut_consultado = $row["RUT_FUNCIONARIO"];
                        $nombre_consultado = $row["NOMBRE_EQUIPO"];
                        $fecha_consultada = $row["FECHA_ADQUISICION"];
                        $costo_consultado = $row["COSTO_ADQUISICION"];
                        $caracteristica_consultada = $row["CARACTERISTICAS_ADQUISICION"];
                        $forma_consultada = $row["FORMA_ADQUISICION"];
                        $estado = $row["estado"];
                        $cantidadMantenciones = $row["cantidad_mantenciones"];

                        $qd = "SELECT NOMBRE_DEPARTAMENTO, id_edificio FROM departamentos WHERE id_departamento=" . $departamento_consultado . ";";
                        $rd = mysqli_query($conexion, $qd);
                        $rowd = mysqli_fetch_assoc($rd);
                        $nombre_departamento = $rowd["NOMBRE_DEPARTAMENTO"];

                        $qe = "SELECT nombre_edificio FROM edificios WHERE id_edificio=" . $rowd["id_edificio"] . ";";
                        $re = mysqli_query($conexion, $qe);
                        $rowe = mysqli_fetch_assoc($re);
                        $nombre_edificio = $rowe["nombre_edificio"];

                        $qf = "SELECT nombre_funcionario FROM funcionarios WHERE rut_funcionario=" . $rut_consultado . ";";
                        $rf = mysqli_query($conexion, $qf);
                        $rowf = mysqli_fetch_assoc($rf);
                        $nombre_funcionario = $rowf["nombre_funcionario"];

                        echo '<tr><td>' . $id_consultado . '</td>';
                        echo '<td>' . $nombre_departamento . '</td>';
                        echo '<td>' . $nombre_edificio . '</td>';
                        echo '<td>' . $nombre_funcionario . '</td>';
                        echo '<td>' . $nombre_consultado . '</td>';
                        echo '<td>' . $fecha_consultada . '</td>';
                        echo '<td>' . $costo_consultado . '</td>';
                        echo '<td>' . $forma_consultada . '</td>';
                        echo '<td>' . $caracteristica_consultada . '</td>';
                        echo '<td>' . $estado . '</td>';
                        echo '<td>' . $cantidadMantenciones . '</td>';
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</body>

</html>