<?php
require('view\partials\gestion_equipos_componentes\conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insertBoton'])) {
        $nombre_equipo = $_POST["nombre_equipo"];
        $rut = $_POST["rut"];
        $fechaAdquisicion = $_POST["fAdquisicion"];
        $costoaAdquisicion = $_POST["cAdquisicion"];
        $caracteristicasAdquisicion = $_POST["tAdquisicion"];
        $formaaAdquisicion = $_POST["foAdquisicion"];
        $id_departamento = $_POST["idDepartamento"];

        $q1 = "INSERT INTO equipos
        VALUES (DEFAULT,'$id_departamento', '$rut', '$nombre_equipo', '$fechaAdquisicion', '$costoaAdquisicion','$caracteristicasAdquisicion', '$formaaAdquisicion');";
        $r1 = mysqli_query($conexion, $q1);
    } else if (isset($_POST['deletedata'])) {
        $id_equipo = $_POST["delete_id"];
        $q2 = "DELETE FROM equipos WHERE id_equipo='" . $id_equipo . "';";
        $r2 = mysqli_query($conexion, $q2);
    } else if (isset($_POST['modificarData'])) {
        $nombre_equipo = $_POST["nombre_equipo"];
        $id_equipo = $_POST["modify_id"];
        $rut = $_POST["rut"];
        $fechaAdquisicion = $_POST["fAdquisicion"];
        $costoaAdquisicion = $_POST["cAdquisicion"];
        $caracteristicasAdquisicion = $_POST["tAdquisicion"];
        $formaaAdquisicion = $_POST["foAdquisicion"];
        $id_departamento = $_POST["id_departamento"];

        $q3 = "UPDATE equipos
        SET id_equipo=" . $id_equipo . ", rut_funcionario=" . $rut . ", nombre_equipo='" . $nombre_equipo . "', fecha_adquisicion='" . $fechaAdquisicion . "', 
        costo_adquisicion=" . $costoaAdquisicion . ",caracteristicas_adquisicion='" . $caracteristicasAdquisicion . "', forma_adquisicion='" . $formaaAdquisicion . "', id_departamento=" . $id_departamento . "
        WHERE id_equipo=" . $id_equipo . ";";
        $r3 = mysqli_query($conexion, $q3);
    }
}

?>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gestión de equipos</h1>

        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="row row-cols-auto d-flex align-items-center">
                    <div class="col-8">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#insertarEquipo">
                            Insertar Nuevo Equipo
                        </button>
                    </div>
                    <div class="col">
                        <h5>Buscar Equipo:</h5>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" aria-label="Busqueda por Parametros">
                    </div>
                </div>
            </div>

            <!-- Modal -->
        </div>
        <div class="modal fade" name="insertarEquipo" id="insertarEquipo" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertarEquipoLabel">Ingresar Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="prueba.php?p=gestion_equipos_componentes\equipos\gestion_equipos" method="post">
                        <div class="modal-body">
                            <div class="container-sm">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre Equipo</span>
                                    <input type="text" aria-label="nombre_equipo" name="nombre_equipo"
                                        class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Rut Funcionario</span>
                                    <input type="text" class="form-control" aria-label="rut" name="rut"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha
                                        Adquisicion</span>
                                    <input type="date" class="form-control" aria-label="fAdquisicion"
                                        name="fAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Costo de
                                        Adquisicion</span>
                                    <textarea type="number" class="form-control" aria-label="cAdquisicion"
                                        name="cAdquisicion" aria-describedby="inputGroup-sizing-default"
                                        required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Caracteristicas
                                        Adquisicion</span>
                                    <input type="text" class="form-control" aria-label="tAdquisicion"
                                        name="tAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Forma
                                        Adquisicion</span>
                                    <input type="text" class="form-control" aria-label="foAdquisicion"
                                        name="foAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Departamento</span>
                                    <select class="form-select" aria-label="Departamento" name="idDepartamento" required>
                                        <option selected disabled value="">Seleccione un Departamento</option>
                                        <?php
                                        $q1 = "SELECT * FROM departamentos;";
                                        $r1 = mysqli_query($conexion, $q1);
                                        while ($row = mysqli_fetch_assoc($r1)) {
                                            $id = $row["ID_DEPARTAMENTO"];
                                            $nombre = $row["NOMBRE_DEPARTAMENTO"];
                                        }
                                        echo '<option value="'.$id.'">'.$nombre.'</option>';
                                        ?>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="insertBoton"
                                id="insertBoton">Ingresar</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_equipos_componentes\equipos\gestion_equipos" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="deleteForm" name="delete_id" id="delete_id">
                            ¿Estas seguro que quieres eliminar el equipo seleccionado?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="deletedata" id="deletedata"
                                class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modificarEquipo" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_equipos_componentes\equipos\gestion_equipos" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="modifyForm" name="modify_id" id="modify_id">
                            <div class="container-sm">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre Equipo</span>
                                    <input type="text" aria-label="nombre_equipo" name="nombre_equipo"
                                        class="form-control">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Rut Funcionario</span>
                                    <input type="text" class="form-control" aria-label="rut" name="rut"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha
                                        Adquisicion</span>
                                    <input type="date" class="form-control" aria-label="fAdquisicion"
                                        name="fAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Costo de
                                        Adquisicion</span>
                                    <textarea type="number" class="form-control" aria-label="cAdquisicion"
                                        name="cAdquisicion" aria-describedby="inputGroup-sizing-default"
                                        required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Caracteristicas
                                        Adquisicion</span>
                                    <input type="text" class="form-control" aria-label="tAdquisicion"
                                        name="tAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Forma
                                        Adquisicion</span>
                                    <input type="text" class="form-control" aria-label="foAdquisicion"
                                        name="foAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Departamento</span>
                                    <input type="number" class="form-control" aria-label="id_departamento"
                                        name="id_departamento" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="modificarData">Modificar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="container-xl d-flex flex-column border border-primary rounded">
            <div class="align-self-center">
                <h4 class="my-4 ">Listado de Equipos</h4>
            </div>
            <div class="table-responsive caption-top">
                <table class="table" id="infoEquipo">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Rut Funcionario</th>
                            <th scope="col">Fecha Adquisicion</th>
                            <th scope="col">Costo Adquisicion</th>
                            <th scope="col">Forma Adquisicion</th>
                            <th scope="col">Caracteristicas</th>
                            <th scope="col mx-auto">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM equipos";
                        $resultado = mysqli_query($conexion, $query);
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $id = $row['ID_EQUIPO'];
                            $nombre = $row["NOMBRE_EQUIPO"];
                            $departamento = $row["ID_DEPARTAMENTO"];
                            $rut = $row["RUT_FUNCIONARIO"];
                            $fechaAdquisicion = $row["FECHA_ADQUISICION"];
                            $costoAdquisicion = $row["COSTO_ADQUISICION"];
                            $caracteristicasAdquisicion = $row["CARACTERISTICAS_ADQUISICION"];
                            $formaAdquisicion = $row["FORMA_ADQUISICION"];
                            echo '<tr>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $nombre . '</td>';
                            echo '<td>' . $departamento . '</td>';
                            echo '<td>' . $rut . '</td>';
                            echo '<td>' . $fechaAdquisicion . '</td>';
                            echo '<td>' . $costoAdquisicion . '</td>';
                            echo '<td>' . $formaAdquisicion . '</td>';
                            echo '<td>' . $caracteristicasAdquisicion . '</td>';
                            echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-icons">delete</span></button>  
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modificarEquipo" data-bs-whatever="' . $id . '"> <span class="material-icons">edit</span> </button>
                            <a class="btn btn-outline-info" href="prueba.php?p=gestion_equipos_componentes/componentes/gestion_componentes&id=' . $id . '" role="button"> <span class="material-icons"> computer </span> </a>
                            <button type="button" class="btn btn-dark"><span class="material-icons"> qr_code </span></button> </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <script src="java.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
    <script>
        var modalDelete = document.getElementById('confirmacionEliminar')
        modalDelete.addEventListener('show.bs.modal', function (event) {
            var buttonDelete = event.relatedTarget
            var attributeDelete = buttonDelete.getAttribute('data-bs-whatever')
            var modal_id_delete = modalDelete.querySelector('.deleteForm')
            modal_id_delete.value = attributeDelete;
        })
    </script>
    <script>
        var modalModify = document.getElementById('modificarEquipo')
        modalModify.addEventListener('show.bs.modal', function (event) {
            var modifyButton = event.relatedTarget
            // Extract info from data-bs-* attributes
            var attributeModify = modifyButton.getAttribute('data-bs-whatever')
            // Update the modal's content.
            var modalId = modalModify.querySelector('.modifyForm')
            modalId.value = attributeModify;
        })
    </script>
</body>

</html>