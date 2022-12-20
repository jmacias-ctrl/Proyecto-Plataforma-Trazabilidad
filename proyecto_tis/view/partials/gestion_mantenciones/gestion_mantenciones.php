<?php
require('conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insertBoton'])) {
        $nombre_mantencion = $_POST["nombre_mantencion"];
        $tMantencion = $_POST["tMantencion"];
        $fMantencion = $_POST["fMantencion"];
        $mantenedorACargo = $_POST["mantenedorACargo"];
        $equipoAMantencion = $_POST["equipoAMantencion"];
        $q1 = "INSERT INTO mantenciones VALUES (DEFAULT," . $equipoAMantencion . ", '" . $nombre_mantencion . "', '" . $tMantencion . "', 1);";

        $q1_2 = "SELECT ID_MANTENCION FROM `mantenciones` ORDER BY ID_MANTENCION DESC LIMIT 1;";

        $r1 = mysqli_query($conexion, $q1);
        $r2 = mysqli_query($conexion, $q1_2);
        $rr2 = mysqli_fetch_assoc($r2);

        $q1_1 = "INSERT INTO realiza VALUES (" . $rr2["ID_MANTENCION"] . "," . $mantenedorACargo . ", '" . $fMantencion . "');";
        $r1_1 = mysqli_query($conexion, $q1_1);

        $q2 = "UPDATE equipos SET estado = 'En mantencion' WHERE id_equipo = " . $equipoAMantencion . ";";
        $r2 = mysqli_query($conexion, $q2);
    } else if (isset($_POST['deletedata'])) {
        $id_mantencion = $_POST["delete_id"];
        $q2 = "SELECT id_equipo FROM mantenciones WHERE id_mantencion = " . $id_mantencion . ";";
        $r2 = mysqli_query($conexion, $q2);
        $row = mysqli_fetch_assoc($r2);

        $q3 = "UPDATE equipos SET estado = 'Inactivo' WHERE id_equipo = " . $row["id_equipo"] . ";";
        $r3 = mysqli_query($conexion, $q3);

        $q2 = "DELETE FROM mantenciones WHERE id_mantencion='" . $id_mantencion . "';";
        $r2 = mysqli_query($conexion, $q2);
    } else if (isset($_POST['modificarData'])) {
        $id_mantencion = $_POST["modify_id"];
        $nombre_mantencion = $_POST["nombre_mantencion"];
        $tMantencion = $_POST["tMantencion"];
        $fMantencion = $_POST["fMantencion"];
        $mantenedorACargo = $_POST["mantenedorACargo"];

        $q3 = "UPDATE mantenciones
        SET id_mantencion=" . $id_mantencion . ", nombre_mantencion='" . $nombre_mantencion . "', tipo_mantencion='" . $tMantencion . "' WHERE id_mantencion=" . $id_mantencion . ";";
        $q4 = "UPDATE realiza
        SET id_mantencion=" . $id_mantencion . ", rut=" . $mantenedorACargo . ", fecha_mantencion='" . $fMantencion . "' WHERE id_mantencion=" . $id_mantencion . ";";
        $r3 = mysqli_query($conexion, $q3);
        $r4 = mysqli_query($conexion, $q4);
    } else if (isset($_POST["confirmTerminacionMantencion"])) {
        $id_mantencion = $_POST["modify_id"];

        $q1 = "UPDATE mantenciones SET en_marcha = false WHERE id_mantencion = " . $id_mantencion . ";";
        $r1 = mysqli_query($conexion, $q1);

        $q2 = "SELECT id_equipo FROM mantenciones WHERE id_mantencion = " . $id_mantencion . ";";
        $r2 = mysqli_query($conexion, $q2);
        $row = mysqli_fetch_assoc($r2);

        $q3 = "UPDATE equipos SET estado = 'Inactivo' WHERE id_equipo = " . $row["id_equipo"] . ";";
        $r3 = mysqli_query($conexion, $q3);
    }
}

?>

<head>
    <title>Gestión de Mantenciones - Trazabilidad de Equipos</title>
</head>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gestión de Mantenciones</h1>

        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="row row-cols-auto d-flex align-items-center">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertarMantenciones">
                            Insertar Nueva Mantención
                        </button>
                    </div>
                    <div class="col">
                        <h5>Buscar Mantención:</h5>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="inputFilter" aria-label="Busqueda por Parametros">
                    </div>
                </div>
            </div>

            <!-- Modal -->
        </div>
        <div class="modal fade" name="insertarMantenciones" id="insertarMantenciones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertarMantencionesLabel">Ingresar Mantención</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="prueba.php?p=gestion_mantenciones\gestion_mantenciones" method="post">
                        <div class="modal-body">
                            <div class="container-sm">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre Mantención</span>
                                    <input type="text" aria-label="nombre_mantencion" name="nombre_mantencion" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Tipo de Mantención</span>
                                    <input type="text" class="form-control" aria-label="tMantencion" name="tMantencion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha de Mantención</span>
                                    <input type="date" class="form-control" aria-label="fMantencion" name="fMantencion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Mantenedor a
                                        Cargo</span>
                                    <select class="form-select" aria-label="mantenedorACargo" name="mantenedorACargo" required>
                                        <option selected disabled value="">Seleccione un Mantenedor</option>
                                        <?php
                                        $q1 = "SELECT * FROM mantenedores;";
                                        $r1 = mysqli_query($conexion, $q1);
                                        while ($row = mysqli_fetch_assoc($r1)) {
                                            $rut = $row["RUT"];
                                            $nombre = $row["NOMBRE"];
                                            echo '<option value="' . $rut . '">' . $nombre . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Equipo a realizar mantención</span>
                                    <select class="form-select" aria-label="equipoAMantencion" name="equipoAMantencion" required>
                                        <option selected disabled value="">Seleccione un Equipo</option>
                                        <?php
                                        $q2 = "SELECT equipos.* FROM equipos, edificios, departamentos, organizaciones WHERE equipos.id_departamento = departamentos.id_departamento 
                                        AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . " AND estado!='En mantencion';";
                                        $r2 = mysqli_query($conexion, $q2);
                                        while ($row2 = mysqli_fetch_assoc($r2)) {
                                            $id = $row2["ID_EQUIPO"];
                                            $nombre = $row2["NOMBRE_EQUIPO"];
                                            echo '<option value="' . $id . '">' . $nombre . '</option>';
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="insertBoton" id="insertBoton">Ingresar</button>
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
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Mantención</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_mantenciones\gestion_mantenciones" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="deleteForm" name="delete_id" id="delete_id">
                            ¿Estás seguro que quieres eliminar la mantención seleccionada?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="deletedata" id="deletedata" class="btn btn-danger">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="confirmacionMantencionRealizado" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmación de término de Mantención</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_mantenciones\gestion_mantenciones" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="terminoForm" name="modify_id" id="modify_id">
                            ¿Estás seguro que la mantención fue terminada?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="confirmTerminacionMantencion" id="confirmTerminacionMantencion" class="btn btn-success">Confirmar Terminacion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="modificarMantenciones" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Mantención</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_mantenciones\gestion_mantenciones" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="modifyForm" name="modify_id" id="modify_id">
                            <div class="container-sm">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre Mantención</span>
                                    <input type="text" aria-label="nombre_mantencion" name="nombre_mantencion" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Tipo de Mantención</span>
                                    <input type="text" class="form-control" aria-label="tMantencion" name="tMantencion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha de Mantención</span>
                                    <input type="date" class="form-control" aria-label="fMantencion" name="fMantencion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Mantenedor a
                                        Cargo</span>
                                    <select class="form-select" aria-label="mantenedorACargo" name="mantenedorACargo" required>
                                        <option selected disabled value="">Seleccione un Mantenedor</option>
                                        <?php
                                        $q1 = "SELECT * FROM mantenedores;";
                                        $r1 = mysqli_query($conexion, $q1);
                                        while ($row = mysqli_fetch_assoc($r1)) {
                                            $rut = $row["RUT"];
                                            $nombre = $row["NOMBRE"];
                                            echo '<option value="' . $rut . '">' . $nombre . '</option>';
                                        }

                                        ?>
                                    </select>
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
                <h4 class="my-4 ">Listado de Mantenciones Activas y Pasadas</h4>
            </div>
            <div class="table-responsive caption-top">
                <table class="table mb-5" id="infoMantencion1">
                    <thead>
                        <tr>
                            <th scope="col">Terminar Mantencion</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">ID Equipo</th>
                            <th scope="col">Nombre Equipo</th>
                            <th scope="col">Tipo de Mantención</th>
                            <th scope="col">Fecha de Mantención</th>
                            <th scope="col">Nombre Mantenedor a Cargo</th>
                            <th scope="col">Rut Mantenedor a Cargo</th>
                            <th scope="col mx-auto">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q2 = "SELECT mantenciones.* FROM mantenciones, equipos, edificios, departamentos, organizaciones WHERE mantenciones.id_equipo = equipos.id_equipo AND equipos.id_departamento = departamentos.id_departamento 
                        AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . " AND en_marcha=true;";
                        $r2 = mysqli_query($conexion, $q2);
                        while ($row2 = mysqli_fetch_assoc($r2)) {
                            $id = $row2['ID_MANTENCION'];
                            $id_equipo = $row2["ID_EQUIPO"];
                            $nombre = $row2["NOMBRE_MANTENCION"];
                            $tipo = $row2["TIPO_MANTENCION"];

                            $q3 = "SELECT realiza.* FROM realiza WHERE id_mantencion=" . $id . ";";
                            $r3 = mysqli_query($conexion, $q3);
                            $rr2 = mysqli_fetch_assoc($r3);

                            $rut_mantenedor = $rr2["RUT"];
                            $fecha_mantencion = $rr2["FECHA_MANTENCION"];

                            $q4 = "SELECT mantenedores.* FROM mantenedores WHERE rut=" . $rut_mantenedor . ";";
                            $r4 = mysqli_query($conexion, $q4);
                            $rr3 = mysqli_fetch_assoc($r4);

                            $nombre_mantenedor = $rr3["NOMBRE"];

                            $q4 = "SELECT equipos.nombre_equipo FROM equipos, edificios, departamentos, organizaciones WHERE equipos.id_departamento = departamentos.id_departamento 
                            AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . " AND id_equipo = " . $id_equipo . ";";
                            $r4 = mysqli_query($conexion, $q4);
                            $rr4 = mysqli_fetch_assoc($r4);

                            $nombre_equipo = $rr4["nombre_equipo"];

                            echo '<tr>';
                            echo '<td><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#confirmacionMantencionRealizado" data-bs-whatever="' . $id . '" ><span class="material-symbols-outlined">done</span></td>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $nombre . '</td>';
                            echo '<td>' . $id_equipo . '</td>';
                            echo '<td>' . $nombre_equipo . '</td>';
                            echo '<td>' . $tipo . '</td>';
                            echo '<td>' . $fecha_mantencion . '</td>';
                            echo '<td>' . $nombre_mantenedor . '</td>';
                            echo '<td>' . $rut_mantenedor . '</td>';
                            echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-icons">delete</span></button>
                            <button type="button" id="modify" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modificarMantenciones" data-bs-whatever="' . $id . '"> <span class="material-icons">edit</span> </button>';
                            echo '</tr>';
                        }
                        echo '<tr><tr/>';
                        $q1 = "SELECT mantenciones.* FROM mantenciones, equipos, edificios, departamentos, organizaciones WHERE mantenciones.id_equipo = equipos.id_equipo AND equipos.id_departamento = departamentos.id_departamento 
                        AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . " AND en_marcha = false;";
                        $r1 = mysqli_query($conexion, $q1);
                        while ($row1 = mysqli_fetch_assoc($r1)) {
                            $id = $row1['ID_MANTENCION'];
                            $id_equipo = $row1["ID_EQUIPO"];
                            $nombre = $row1["NOMBRE_MANTENCION"];
                            $tipo = $row1["TIPO_MANTENCION"];

                            $q2 = "SELECT realiza.* FROM realiza WHERE id_mantencion=" . $id . ";";
                            $r2 = mysqli_query($conexion, $q2);
                            $rr2 = mysqli_fetch_assoc($r2);

                            $rut_mantenedor = $rr2["RUT"];
                            $fecha_mantencion = $rr2["FECHA_MANTENCION"];

                            $q3 = "SELECT mantenedores.* FROM mantenedores WHERE rut=" . $rut_mantenedor . ";";
                            $r3 = mysqli_query($conexion, $q3);
                            $rr3 = mysqli_fetch_assoc($r3);

                            $nombre_mantenedor = $rr3["NOMBRE"];

                            $q4 = "SELECT equipos.nombre_equipo FROM equipos, edificios, departamentos, organizaciones WHERE equipos.id_departamento = departamentos.id_departamento 
                            AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . " AND id_equipo = " . $id_equipo . ";";
                            $r4 = mysqli_query($conexion, $q4);
                            $rr4 = mysqli_fetch_assoc($r4);

                            $nombre_equipo = $rr4["nombre_equipo"];

                            echo '<tr>';
                            echo '<td>  </td>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $nombre . '</td>';
                            echo '<td>' . $id_equipo . '</td>';
                            echo '<td>' . $nombre_equipo . '</td>';
                            echo '<td>' . $tipo . '</td>';
                            echo '<td>' . $fecha_mantencion . '</td>';
                            echo '<td>' . $nombre_mantenedor . '</td>';
                            echo '<td>' . $rut_mantenedor . '</td>';
                            echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-icons">delete</span></button>  ';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src="java.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script type="text/javascript" src="view/partials/jquery.min.js"></script>
    <script>
        var modalDelete = document.getElementById('confirmacionEliminar')
        modalDelete.addEventListener('show.bs.modal', function(event) {
            var buttonDelete = event.relatedTarget
            var attributeDelete = buttonDelete.getAttribute('data-bs-whatever')
            var modal_id_delete = modalDelete.querySelector('.deleteForm')
            modal_id_delete.value = attributeDelete;
        })
    </script>
    <script>
        var modalTermino = document.getElementById('confirmacionMantencionRealizado')
        modalTermino.addEventListener('show.bs.modal', function(event) {
            var buttonTermino = event.relatedTarget
            var attributeDelete = buttonTermino.getAttribute('data-bs-whatever')
            var modal_id_termino = modalTermino.querySelector('.terminoForm')
            modal_id_termino.value = attributeDelete;
        })
    </script>
    <script>
        var modalModify = document.getElementById('modificarMantenciones')
        modalModify.addEventListener('show.bs.modal', function(event) {
            var modifyButton = event.relatedTarget
            // Extract info from data-bs-* attributes
            var attributeModify = modifyButton.getAttribute('data-bs-whatever')
            // Update the modal's content.
            var modalId = modalModify.querySelector('.modifyForm')

            modalId.value = attributeModify;
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#inputFilter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#infoMantencion1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                $("#infoMantencion2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>