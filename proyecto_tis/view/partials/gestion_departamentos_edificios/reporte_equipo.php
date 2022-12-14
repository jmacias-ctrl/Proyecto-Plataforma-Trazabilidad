<?php

//bd-user-pass-id
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "tis";
    
    $conexion = mysqli_connect($server, $user, $password, $database);

?>


<body>
    <br>
    <br>
    <br>
    <div class="container-xl d-flex flex-column border border-primary rounded">
        <div><a class="btn btn-borderline-success" href="prueba.php?p=gestion_equipos_componentes/equipos/gestion_equipos" role="button"><span class="material-icons">arrow_back</span></a></div>
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