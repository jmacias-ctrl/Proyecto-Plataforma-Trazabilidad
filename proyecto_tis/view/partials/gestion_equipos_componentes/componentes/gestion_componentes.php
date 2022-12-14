<?php
require('conexion.php');
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['id_equipo'])) {
    if (isset($_GET['id']) && $_SESSION['id_equipo'] != $_GET['id']) {
        $_SESSION['id_equipo'] = $_GET['id'];
    }
} else {
    $_SESSION['id_equipo'] = $_GET['id'];
}
$id_equipo = $_SESSION['id_equipo'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["deletedata"])) {
        $idComponente = $_POST["delete_id"];
        $query = "DELETE FROM componentes WHERE id_componente=" . $idComponente . ";";
        $resultado = mysqli_query($conexion, $query);
    } else if (isset($_POST["moverdata"])) {
        $idComponente = $_POST["mover_id"];

        $query = "UPDATE componentes SET estado='en bodega', id_equipo=null WHERE id_componente=" . $idComponente . ";";
        $resultado = mysqli_query($conexion, $query);
    } else {
        $nComponente = $_POST["nComponente"];
        $mComponente = $_POST["mComponente"];
        $modComponente = $_POST["modComponente"];
        $selectComponente = $_POST["selectComponente"];

        $query = "INSERT INTO componentes
        VALUES (DEFAULT,'$id_equipo', '$nComponente', '$mComponente', '$modComponente', 'en uso', '$selectComponente', 1)";
        $query2 = null;
        $getIdQuery = "SELECT id_componente FROM componentes ORDER BY id_componente DESC limit 1";
        $resultado = mysqli_query($conexion, $query);
        $getIdResult = mysqli_query($conexion, $getIdQuery);
        $getIdRow = mysqli_fetch_assoc($getIdResult);
        $getId = $getIdRow["id_componente"];
        switch ($selectComponente) {
            case 'otros':
                break;
            case 'procesador':
                $cpuNucleo = $_POST["cpuNucleo"];
                $cpuSocket = $_POST["cpuSocket"];
                $cpuRelojBase = $_POST["cpuRelojBase"];
                $cpuHilos = $_POST["cpuHilos"];


                $query2 = "INSERT INTO procesadores
                    VALUES ($getId,'$cpuNucleo', '$cpuSocket', '$cpuRelojBase', '$cpuHilos')";
                break;
            case 'placa base':
                $factorFormaPB = $_POST["factorFormaPB"];
                $pbSocket = $_POST["pbSocket"];
                $soporteMemoria = $_POST["soporteMemoria"];
                $pbCaracteristicas = $_POST["pbCaracteristicas"];

                $query2 = "INSERT INTO placa_base
                    VALUES ( $getId,'$factorFormaPB', '$pbSocket', '$soporteMemoria', '$pbCaracteristicas')";
                break;
            case 'ram':
                $ramMemoria = $_POST["ramMemoria"];
                $ramTecnologia = $_POST["ramTecnologia"];
                $ramVelocidadFrequencia = $_POST["ramVelocidadFrequencia"];
                $query2 = "INSERT INTO memorias_ram
                    VALUES ($getId,'$ramVelocidadFrequencia', '$ramMemoria', '$ramTecnologia')";
                break;
            case 'disco interno':
                $discoCapacidad = $_POST["discoCapacidad"];
                $idDisco = $_POST["idDisco"];
                $query2 = "INSERT INTO discos_internos
                    VALUES ($getId,'$discoCapacidad', '$idDisco')";
                break;
        }

        if ($query2 != null) {
            $resultado = mysqli_query($conexion, $query2);
        }
    }
    unset($_POST);
}

?>
<title> Gesti??n de Componentes del Equipo: <?php print($id_equipo); ?> </title>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gesti??n de Componentes por Equipo</h1>
        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
                    <div class="container aling-self-center">
                        <div class="row"></div>
                        <div class="row row-cols-auto d-flex align-items-center">
                            <div class="col">
                                <a class="btn btn-borderline-success" href="prueba.php?p=gestion_equipos_componentes/equipos/gestion_equipos" role="button"><span class="material-icons">arrow_back</span></a>
                            </div>
                            <div class="col">

                                <?php
                                $q1 = "SELECT nombre_equipo FROM equipos WHERE id_equipo=" . $id_equipo . ";";
                                $r1 = mysqli_query($conexion, $q1);
                                $row = mysqli_fetch_assoc($r1);
                                echo '<h4>Equipo N??' . $id_equipo . ' - ' . $row['nombre_equipo'] . '</h4>';
                                ?>
                            </div>
                            <div class="col">
                                <div class="dropdown">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        Insertar Nuevo Componente
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#insertarProcesador" href="#">Procesador</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#insertarDiscoInterno" href="#">Discos Internos</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#insertarRAM" href="#">Memorias Ram</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#insertarPB" href="#">Placa Base</a></li>
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#insertarOtro" href="#">Otro</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col">
                                <h5>Buscar Componente:</h5>
                            </div>
                            <div class="col">
                                <input type="text" id="inputFilter" class="form-control" aria-label="Busqueda por Parametros">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="insertarOtro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertarOtro    Label">Ingresar Componente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes\componentes\gestion_componentes" method="post">
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="otros">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Nombre
                                                Componente</span>
                                            <input type="text" class="form-control" aria-label="nComponente" name="nComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el nombre para el componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                                            <input type="text" class="form-control" aria-label="mComponente" name="mComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca la marca del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                                            <input type="text" class="form-control" aria-label="modComponente" name="modComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el modelo del componente.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="insertarProcesador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertarProcesadorLabel">Ingresar Procesador</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes\componentes\gestion_componentes" method="post">
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="procesador">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Nombre
                                                Componente</span>
                                            <input type="text" class="form-control" aria-label="nComponente" name="nComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el nombre para el componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                                            <input type="text" class="form-control" aria-label="mComponente" name="mComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca la marca del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                                            <input type="text" class="form-control" aria-label="modComponente" name="modComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el modelo del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">N??cleos</span>
                                            <input type="number" aria-label="cpuNucleo" name="cpuNucleo" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Socket</span>
                                            <input type="text" aria-label="cpuSocket" name="cpuSocket" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Reloj Base</span>
                                            <input type="number" class="form-control" aria-label="cpuRelojBase" name="cpuRelojBase" aria-describedby="inputGroup-sizing-default">
                                            <span class="input-group-text">GHz</span>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Hilos</span>
                                            <input type="number" class="form-control" aria-label="cpuHilos" name="cpuHilos" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="insertarPB" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertarPBLabel">Ingresar Placa Base</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes\componentes\gestion_componentes" method="post">
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="placa base">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Nombre
                                                Componente</span>
                                            <input type="text" class="form-control" aria-label="nComponente" name="nComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el nombre para el componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                                            <input type="text" class="form-control" aria-label="mComponente" name="mComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca la marca del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                                            <input type="text" class="form-control" aria-label="modComponente" name="modComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el modelo del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Factor de Forma</span>
                                            <input type="text" aria-label="factorFormaPB" name="factorFormaPB" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">CPU Socket</span>
                                            <input type="text" aria-label="pbSocket" name="pbSocket" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Soporte Memoria</span>
                                            <input type="text" aria-label="soporteMemoria" name="soporteMemoria" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">

                                            <span class="input-group-text">Caracter??sticas</span>
                                            <input type="text" class="form-control" aria-label="pbCaracteristicas" name="pbCaracteristicas" aria-describedby="inputGroup-sizing-default">
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="insertarRAM" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertarRAMLabel">Ingresar Memoria Ram</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes\componentes\gestion_componentes" method="post">
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="ram">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Nombre
                                                Componente</span>
                                            <input type="text" class="form-control" aria-label="nComponente" name="nComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el nombre para el componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                                            <input type="text" class="form-control" aria-label="mComponente" name="mComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca la marca del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                                            <input type="text" class="form-control" aria-label="modComponente" name="modComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el modelo del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Memoria</span>
                                            <input type="number" aria-label="ramMemoria" name="ramMemoria" class="form-control">
                                            <span class="input-group-text">GB</span>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Tecnolog??a</span>
                                            <input type="text" aria-label="ramTecnologia" name="ramTecnologia" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Velocidad Frequencia</span>
                                            <input type="number" class="form-control" aria-label="ramVelocidadFrequencia" name="ramVelocidadFrequencia" aria-describedby="inputGroup-sizing-default">
                                            <span class="input-group-text">MHz</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="insertarDiscoInterno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertarDiscoInternoLabel">Ingresar Disco Interno</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes\componentes\gestion_componentes" method="post">
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="disco interno">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Nombre
                                                Componente</span>
                                            <input type="text" class="form-control" aria-label="nComponente" name="nComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el nombre para el componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                                            <input type="text" class="form-control" aria-label="mComponente" name="mComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca la marca del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                                            <input type="text" class="form-control" aria-label="modComponente" name="modComponente" aria-describedby="inputGroup-sizing-default" required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el modelo del componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Capacidad</span>
                                            <input type="number" required aria-label="discoCapacidad" name="discoCapacidad" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Tipo Disco</span>
                                            <select class="form-select" aria-label="Equipos" name='idDisco' required>
                                                <option selected>Seleccionar Tipo de Disco</option>
                                                <?php
                                                $qEquipos = "SELECT * FROM tipo_discos_internos;";
                                                $rEquipos = mysqli_query($conexion, $qEquipos);

                                                while ($rowEquipos = mysqli_fetch_assoc($rEquipos)) {
                                                    echo "<option value=" . $rowEquipos['ID_TIPO_DISCO'] . ">" . $rowEquipos['NOMBRE_TIPO'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="confirmacionEliminar" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Componente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes/componentes/gestion_componentes" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" class="deleteForm" name="delete_id" id="delete_id">
                                    ??Est??s seguro que quieres eliminar el componente seleccionado?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="deletedata" class="btn btn-danger">Eliminar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="moverBodega" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Mover componente a bodega</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes/componentes/gestion_componentes" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" class="moverForm" name="mover_id" id="mover_id">
                                    ??Estas seguro que quieres mover el componente seleccionado a bodega?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="moverdata" class="btn btn-danger">Mover</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-xl d-flex flex-column border border-primary rounded">
                    <div class="align-self-center">
                        <h4 class="my-4 ">Listado de Componentes</h4>
                    </div>
                    <div class="table-responsive caption-top">
                        <table class="table" id="infoGestion">
                            <thead>
                                <tr>
                                    <th scope="col">Ver</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM componentes WHERE id_equipo =" . $id_equipo . ";";
                                $resultado = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_assoc($resultado)) {
                                    $id = $row['ID_COMPONENTE'];
                                    $nombre = $row["NOMBRE"];
                                    $marca = $row["MARCA"];
                                    $modelo = $row["MODELO"];
                                    $tipo = $row["tipo"];
                                    echo '<tr>';
                                    echo '<td><a class="btn btn-outline-info" href="prueba.php?p=gestion_equipos_componentes/componentes/reporte_componente&id=' . $id . '&id_equipo=' . $id_equipo . '" role="button"><span class="material-symbols-outlined">info</span> </a></td>';
                                    echo '<td>' . $id . '</td>';
                                    echo '<td>' . $nombre . '</td>';
                                    echo '<td>' . $marca . '</td>';
                                    echo '<td>' . $modelo . '</td>';
                                    echo '<td>' . $tipo . '</td>';
                                    echo '<td>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-symbols-outlined"> delete </span> </button>
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#moverBodega" data-bs-whatever="' . $id . '" ><span class="material-symbols-outlined"> inventory_2 </span> </button></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="java.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script>
        var modal = document.getElementById('confirmacionEliminar')
        var modal_id_delete = modal.querySelector('.deleteForm')
        modal.addEventListener('show.bs.modal', function(event) {
            var buttonDelete = event.relatedTarget
            var attributeDelete = buttonDelete.getAttribute('data-bs-whatever')
            modal_id_delete.value = attributeDelete;
        })
    </script>
    <script>
        var modal = document.getElementById('moverBodega')
        modal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // Update the modal's content.
            var modalId = modal.querySelector('.moverForm')
            modalId.value = recipient;
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#inputFilter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#infoGestion tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>