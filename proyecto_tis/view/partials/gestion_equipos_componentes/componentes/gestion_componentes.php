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
    } else {
        $nComponente = $_POST["nComponente"];
        $mComponente = $_POST["mComponente"];
        $modComponente = $_POST["modComponente"];
        $selectComponente = $_POST["selectComponente"];

        $query = "INSERT INTO componentes
        VALUES (DEFAULT,'$id_equipo', '$nComponente', '$mComponente', '$modComponente', 'en uso', '$selectComponente')";
        $query2 = null;
        $getIdQuery = "SELECT componentes.* FROM componentes WHERE nombre = '" . $nComponente . "' AND id_equipo = ".$_SESSION['id_equipo'].";";
        $resultado = mysqli_query($conexion, $query);
        $getIdResult = mysqli_query($conexion, $getIdQuery);
        $getIdRow = mysqli_fetch_assoc($getIdResult);
        $getId = $getIdRow["ID_COMPONENTE"];
        switch ($selectComponente) {
            case 'form1':
                break;
            case 'form2':
                $cpuNucleo = $_POST["cpuNucleo"];
                $cpuSocket = $_POST["cpuSocket"];
                $cpuRelojBase = $_POST["cpuRelojBase"];
                $cpuHilos = $_POST["cpuHilos"];


                $query2 = "INSERT INTO procesadores
                    VALUES ($getId,'$cpuNucleo', '$cpuSocket', '$cpuRelojBase', '$cpuHilos')";
                break;
            case 'form3':
                $factorFormaPB = $_POST["factorFormaPB"];
                $pbSocket = $_POST["pbSocket"];
                $soporteMemoria = $_POST["soporteMemoria"];
                $pbCaracteristicas = $_POST["pbCaracteristicas"];

                $query2 = "INSERT INTO memorias_ram
                    VALUES ( $getId,'$factorFormaPB', '$pbSocket', '$soporteMemoria', '$pbCaracteristicas')";
                break;
            case 'form4':
                $ramMemoria = $_POST["ramMemoria"];
                $ramTecnologia = $_POST["ramTecnologia"];
                $ramVelocidadFrequencia = $_POST["ramVelocidadFrequencia"];
                $query2 = "INSERT INTO memorias_ram
                    VALUES ($getId,'$ramVelocidadFrequencia', '$ramMemoria', '$ramTecnologia')";
                break;
            case 'form5':
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
<title> Gestión de Componentes </title>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gestión de Componentes</h1>
        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
                    <div class="container aling-self-center">
                        <div class="row"></div>
                        <div class="row row-cols-auto d-flex align-items-center">
                            <div class="col">
                                <a class="btn btn-borderline-success" href="prueba.php?p=gestion_equipos_componentes/equipos/gestion_equipos" role="button"><span class="material-icons">arrow_back</span></a>
                            </div>
                            <div class="col-8">

                                <?php
                                $q1 = "SELECT nombre_equipo FROM equipos WHERE id_equipo=" . $id_equipo . ";";
                                $r1 = mysqli_query($conexion, $q1);
                                $row = mysqli_fetch_assoc($r1);
                                echo '<h4>Equipo N°' . $id_equipo . ' - ' . $row['nombre_equipo'] . '</h4>';
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
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="form1">
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
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="form2">
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
                                            <span class="input-group-text">Núcleos</span>
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
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="form3">
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
                                            <span class="input-group-text">Características</span>
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
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="form4">
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
                                            <span class="input-group-text">Tecnología</span>
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
                                        <input type="hidden" name="selectComponente" id="selectComponente" value="form5">
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
                                            <input type="number" required aria-label="idDisco" name="idDisco" class="form-control">
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
                                    ¿Estás seguro que quieres eliminar el componente seleccionado?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" name="deletedata" class="btn btn-danger">Eliminar</button>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Ver</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
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
                                    echo '<tr>';
                                    echo '<td><a class="btn btn-outline-info" href="prueba.php?p=gestion_equipos_componentes/componentes/reporte_componente&id=' . $id . '&id_equipo='.$id_equipo.'" role="button"><span class="material-symbols-outlined">info</span> </a></td>';
                                    echo '<td>' . $id . '</td>';
                                    echo '<td>' . $nombre . '</td>';
                                    echo '<td>' . $marca . '</td>';
                                    echo '<td>' . $modelo . '</td>';
                                    echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-icons">delete</span></button></button> </td>';
                                    echo '<td> <button type="button" class="btn btn-outline-primary"><span class="material-icons">edit</span> </button> </td>';
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
        modal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-whatever')
            // Update the modal's content.
            var modalId = modal.querySelector('.deleteForm')
            modalId.value = recipient;
        })
    </script>
</body>

</html>