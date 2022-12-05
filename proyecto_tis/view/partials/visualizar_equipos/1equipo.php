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

    <div class="container-xl d-flex flex-column border border-primary rounded">
        <div class="align-self-center">

        </div>
        <table>
            <thead>
                <tr>
                    <th>Id equipo</th>
                    <th>Id departamento</th>
                    <th>Rut del Funcionario</th>
                    <th>Nombre del equipo</th>
                    <th>Fecha de adquisicion</th>
                    <th>Costa de adquisicion</th>
                    <th>Forma adquisicion</th>
                    <th>Caracteristicas de adquisicion</th>

                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql_e = "SELECT * FROM equipos ";
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

                        echo '<tr><td>' . $id_consultado . '</td>';
                        echo '<td>' . $departamento_consultado . '</td>';
                        echo '<td>' . $rut_consultado . '</td>';
                        echo '<td>' . $nombre_consultado . '</td>';
                        echo '<td>' . $fecha_consultada . '</td>';
                        echo '<td>' . $costo_consultado . '</td>';
                        echo '<td>' . $forma_consultada . '</td>';
                        echo '<td>' . $caracteristica_consultada . '</td></tr>';
                    }
                }

                ?>
            </tbody>
        </table>

</body>

</html>