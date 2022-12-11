<?php

//bd-user-pass-id
require('conexion.php');

?>


<body>
    <br>
    <br>
    <br>
    <div class="container-xl d-flex flex-column border border-primary rounded">
        <div><a class="btn btn-borderline-success" href="prueba.php?p=gestion_equipos_componentes/componentes/gestion_componentes&id=<?php print $_GET["id_equipo"]?>" role="button"><span class="material-icons">arrow_back</span></a></div>

        <div class="align-self-center">
            <h4 class="my-4 ">Reporte del Componente</h4>
        </div>
        <ul class="list-group">
            <?php
            $id_recibido = $_GET['id'];
            $sql_c = "SELECT * FROM componentes WHERE ID_COMPONENTE='$id_recibido';";
            $check_c = mysqli_query($conexion, $sql_c);

            if (mysqli_num_rows($check_c) != 0) {
                while ($row = mysqli_fetch_assoc($check_c)) {
                    $id_componente = $row["ID_COMPONENTE"];
                    $id_equipo = $row["ID_EQUIPO"];
                    $nombre = $row["NOMBRE"];
                    $marca = $row["MARCA"];
                    $modelo = $row["MODELO"];
                    $estado = $row["estado"];
                    $tipo = $row["tipo"];

                    $sql_e = "SELECT nombre_equipo FROM equipos WHERE id_equipo=" . $id_equipo . ";";
                    $check_e = mysqli_query($conexion, $sql_e);
                    $row_e = mysqli_fetch_assoc($check_e);

                    $nombre_equipo = $row_e["nombre_equipo"];

                    echo '<li class="list-group-item">ID componente: ' . $id_componente . '</li>';
                    echo '<li class="list-group-item">Nombre del componente: ' . $nombre . '</li>';
                    echo '<li class="list-group-item">Marca del componente: ' . $marca . '</li>';
                    echo '<li class="list-group-item">Modelo del componente: ' . $modelo . '</li>';
                    echo '<li class="list-group-item">Estado: ' . $estado . '</li>';
                    echo '<li class="list-group-item">Siendo utilizado por el equipo id:' . $id_equipo . '</li>';
                    echo '<li class="list-group-item">Nombre del equipo: ' . $nombre_equipo . '</li>';
                    echo '<li class="list-group-item">Tipo de componente: ' . $tipo . '</li>';
                }
            }
            ?>
        </ul>
        <?php
        if ($tipo != 'otros') {
        ?>
            <div class="align-self-center">
                <h4 class="my-4 ">Más información</h4>
            </div>
            <ul class="list-group">
                <?php switch ($tipo) {
                    case 'procesador':
                        $sql_t = "SELECT * FROM procesadores WHERE id_componente=" . $id_componente . ";";
                        $check_t = mysqli_query($conexion, $sql_t);
                        $row_t = mysqli_fetch_assoc($check_t);
                        $cpuNucleo = $row_t["NUCLEOS"];
                        $cpuSocket = $row_t["SOCKET"];
                        $cpuRelojBase = $row_t["RELOJ_BASE"];
                        $cpuHilos = $row_t["HILOS"];
                        echo "<thead>";
                        echo "<tr>";
                        echo '<li class="list-group-item">Cantidad de núcleos: ' . $cpuNucleo . '</li>';
                        echo '<li class="list-group-item">Cantidad de hilos: ' . $cpuHilos . '</li>';
                        echo '<li class="list-group-item">Socket: ' . $cpuHilos . '</li>';
                        echo '<li class="list-group-item">Reloj Base: ' . $cpuRelojBase . '</li>';
                        echo '</tr>';
                        echo '</thead>';
                        break;
                    case 'placa base':
                        $sql_t = "SELECT * FROM placa_base WHERE id_componente=" . $id_componente . ";";
                        $check_t = mysqli_query($conexion, $sql_t);
                        $row_t = mysqli_fetch_assoc($check_t);
                        $factorFormaPB = $row_t["FACTOR_DE_FORMA"];
                        $pbSocket = $row_t["CPU_SOCKET"];
                        $soporteMemoria = $row_tT["SOPORTE_MEMORIA"];
                        $pbCaracteristicas = $row_t["CARACTERISTICAS"];
                        echo "<thead>";
                        echo "<tr>";
                        echo '<li class="list-group-item">Factor de Forma: ' . $factorFormaPB . '</li>';
                        echo '<li class="list-group-item">CPU Socket Soportado: ' . $pbSocket . '</li>';
                        echo '<li class="list-group-item">Soporte de Memoria: ' . $soporteMemoria . '</li>';
                        echo '<li class="list-group-item">Características: ' . $pbCaracteristicas . '</li>';
                        echo '</tr>';
                        echo '</thead>';
                        break;
                    case 'ram':
                        $sql_t = "SELECT * FROM memorias_ram WHERE id_componente=" . $id_componente . ";";
                        $check_t = mysqli_query($conexion, $sql_t);
                        $row_t = mysqli_fetch_assoc($check_t);
                        $ramMemoria = $row_t["MEMORIA"];
                        $ramTecnologia = $row_t["TECNOLOGIA"];
                        $ramVelocidadFrequencia = $row_t["VELOCIDAD_FRECUENCIA"];
                        echo "<thead>";
                        echo "<tr>";
                        echo '<li class="list-group-item">Cantidad de memoria: ' . $ramMemoria . '</li>';
                        echo '<li class="list-group-item">Tecnología de memoria: ' . $ramTecnologia . '</li>';
                        echo '<li class="list-group-item">Velocidad de Frecuencia: ' . $ramVelocidadFrequencia . '</li>';
                        echo '</tr>';
                        echo '</thead>';
                        break;
                    case 'disco interno':
                        $sql_t = "SELECT * FROM discos_internos WHERE id_componente=" . $id_componente . ";";
                        $check_t = mysqli_query($conexion, $sql_t);
                        $row_t = mysqli_fetch_assoc($check_t);
                        $discoCapacidad = $row_t["CAPACIDAD"];
                        $idTipoDisco = $row_t["ID_TIPO_DISCO"];

                        $sql_td = "SELECT nombre_tipo FROM tipo_discos_internos WHERE id_tipo_disco=" . $idTipoDisco . ";";
                        $check_td = mysqli_query($conexion, $sql_td);
                        $row_td = mysqli_fetch_assoc($check_td);
                        $tipoDisco = $row_td["nombre_tipo"];

                        echo "<thead>";
                        echo "<tr>";
                        echo '<li class="list-group-item">Capacidad del Disco: ' . $discoCapacidad . '</li>';
                        echo '<li class="list-group-item">Tipo de disco: ' . $tipoDisco . '</li>';
                        echo '</tr>';
                        echo '</thead>';
                        break;
                } ?>
            </ul>
        <?php
        }
        ?>
    </div>
</body>

</html>