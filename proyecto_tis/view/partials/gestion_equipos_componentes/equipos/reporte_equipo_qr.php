<?php

//bd-user-pass-id
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "tis";

    $conexion = mysqli_connect($server, $user, $password, $database);

?>

<!DOCTYPE html>
<html lang="en">
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
</head>
<body>
<br>
    <br>
    <br>
    <div class="container-xl d-flex flex-column border border-primary rounded">
        <div class="align-self-center">
            <h4 class="my-4 ">Reporte del Equipo</h4>
        </div>
        <ul class="list-group">
            <?php
            $id_recibido = $_GET['id'];
            $sql_e = "SELECT equipos.*, datediff(current_date(), fecha_adquisicion) as dias_uso FROM equipos WHERE ID_EQUIPO='$id_recibido';";
            $check_e = mysqli_query($conexion, $sql_e);

            if (mysqli_num_rows($check_e) != 0) {
                while ($row = mysqli_fetch_assoc($check_e)) {
                    $id_equipo_consultado = $row["ID_EQUIPO"];
                    $departamento_consultado = $row["ID_DEPARTAMENTO"];
                    $rut_consultado = $row["RUT_FUNCIONARIO"];
                    $nombre_consultado = $row["NOMBRE_EQUIPO"];
                    $fecha_consultada = $row["FECHA_ADQUISICION"];
                    $costo_consultado = $row["COSTO_ADQUISICION"];
                    $caracteristica_consultada = $row["CARACTERISTICAS_ADQUISICION"];
                    $forma_consultada = $row["FORMA_ADQUISICION"];

                    $qd = "SELECT NOMBRE_DEPARTAMENTO, id_edificio FROM departamentos WHERE id_departamento=" . $departamento_consultado . ";";
                    $rd = mysqli_query($conexion, $qd);
                    $rowd = mysqli_fetch_assoc($rd);
                    $nombre_departamento = $rowd["NOMBRE_DEPARTAMENTO"];

                    $qe = "SELECT nombre_edificio FROM edificios WHERE id_edificio=" . $rowd["id_edificio"] . ";";
                    $re = mysqli_query($conexion, $qe);
                    $rowe = mysqli_fetch_assoc($re);
                    $nombre_edificio = $rowe["nombre_edificio"];
                    $estado = $row["estado"];
                    $tiempo = $row["dias_uso"];

                    $qf = "SELECT nombre_funcionario FROM funcionarios WHERE rut_funcionario=" . $rut_consultado . ";";
                    $rf = mysqli_query($conexion, $qf);
                    $rowf = mysqli_fetch_assoc($rf);
                    $nombre_funcionario = $rowf["nombre_funcionario"];

                    echo '<li class="list-group-item">ID equipo: ' . $id_equipo_consultado . '</li>';
                    echo '<li class="list-group-item">RUT del funcionario: ' . $rut_consultado . '</li>';
                    echo '<li class="list-group-item">Nombre del funcionario: ' . $nombre_funcionario . '</li>';
                    echo '<li class="list-group-item">Nombre del equipo: ' . $nombre_consultado . '</li>';
                    echo '<li class="list-group-item">Perteneciente al departamento de ' . $nombre_departamento . ' del edificio ' . $nombre_edificio . '</li>';
                    echo '<li class="list-group-item">Fecha de adquisicion: ' . $fecha_consultada . '</li>';
                    echo '<li class="list-group-item">Costo de adquisicion: $' . $costo_consultado . '</li>';
                    echo '<li class="list-group-item">Caracteristicas de adquisicion: ' . $caracteristica_consultada . '</li>';
                    echo '<li class="list-group-item">Forma de adquisicion: ' . $forma_consultada . '</li>';
                    echo '<li class="list-group-item">Estado del equipo: ' . $estado . '</li>';
                    echo '<li class="list-group-item">Antigüedad: ' . $tiempo . ' días </li>';
                }
            }
            ?>
        </ul>
        <div class="align-self-center">
            <h4 class="my-4 ">Componentes del equipo</h4>
        </div>
        <div class="table-responsive caption-top">
            <table class="table" id="infoComponentes">
                <thead>
                    <tr>
                        <th scope="col">Id componente</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Modelo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $consulta = "SELECT * FROM componentes WHERE ID_EQUIPO = " . $id_recibido . ";";
                    $resultado = mysqli_query($conexion, $consulta);

                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $id_consultado = $row["ID_COMPONENTE"];
                        $nombre_consultado = $row["NOMBRE"];
                        $marca_consultada = $row["MARCA"];
                        $modelo_consultado = $row["MODELO"];
                        echo "<tr>";
                        echo "<td>" . $id_consultado . "</td>";
                        echo  "<td>" . $nombre_consultado . "</td>";
                        echo  "<td>" . $marca_consultada . "</td>";
                        echo  "<td>" . $modelo_consultado . "</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
        <div class="align-self-center">
            <h4 class="my-4 ">Historial de manteciones del equipo</h4>
        </div>
        <div class="table-responsive caption-top">
            <table class="table" id="infoComponentes">
                <thead>
                    <tr>
                        <th scope="col">Id Mantencion</th>
                        <th scope="col">Nombre mantencion</th>
                        <th scope="col">Rut del Mantenedor</th>
                        <th scope="col">Tipo mantencion</th>
                        <th scope="col">Fecha de Mantencion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $c1 = "SELECT * FROM mantenciones WHERE ID_EQUIPO = " . $id_recibido . ";";
                    $r1 = mysqli_query($conexion, $c1);

                    while ($row = mysqli_fetch_assoc($r1)) {
                        $id_consultado = $row["ID_MANTENCION"];
                        $nombre_consultado = $row["NOMBRE_MANTENCION"];
                        $tipo_consultado = $row["TIPO_MANTENCION"];

                        $c2 = "SELECT * FROM realiza WHERE id_mantencion = " . $id_consultado . ";";
                        $r2 = mysqli_query($conexion, $c2);
                        $row2 = mysqli_fetch_assoc($r2);

                        $rut_consultado = $row2["RUT"];
                        $fecha_consultado = $row2["FECHA_MANTENCION"];

                        echo "<tr>";
                        echo "<td>" . $id_consultado . "</td>";
                        echo  "<td>" . $nombre_consultado . "</td>";
                        echo  "<td>" . $rut_consultado . "</td>";
                        echo  "<td>" . $tipo_consultado . "</td>";
                        echo  "<td>" . $fecha_consultado . "</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>