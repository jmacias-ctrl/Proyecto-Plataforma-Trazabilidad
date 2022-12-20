<?php
require('conexion.php');
if(isset($_GET['id']))
$_SESSION['id_edificio'] = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insertBoton'])) {
        $nombre_recibido = $_POST["nombre_departamento"];

        $sql = "INSERT INTO departamentos VALUES(DEFAULT, ".$_SESSION['id_edificio'].",'$nombre_recibido')";
        $resultado = mysqli_query($conexion, $sql);
    } else if (isset($_POST['deletedata'])) {
        $id_consultado = $_POST['delete_id'];

        $sql = "DELETE FROM departamentos WHERE id_departamento='$id_consultado'";
        $resultado = mysqli_query($conexion, $sql);
    } else if (isset($_POST['modificarData'])) {
        $id_consultado = $_POST["modify_id"];
        $nombre_recibido = $_POST["nombre_departamento"];
        $sql = "UPDATE departamentos SET nombre_departamento ='".$nombre_recibido."' WHERE id_departamento='$id_consultado'";
        $resultado = mysqli_query($conexion, $sql);
    }
}

?>
<title> Gestión de Departamentos </title>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gestión de Departamentos</h1>
        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">

                <div class="row row-cols-auto d-flex align-items-center">
                    <div class="col">
                        <a class="btn btn-borderline-success" href="prueba.php?p=gestion_departamentos_edificios\gestion_edificios" role="button"><span class="material-icons">arrow_back</span></a>
                    </div>
                    <div class="col-4">

                        <?php
                        $q1 = "SELECT nombre_edificio FROM edificios WHERE id_edificio=" . $_SESSION['id_edificio'] . ";";
                        $r1 = mysqli_query($conexion, $q1);
                        $row = mysqli_fetch_assoc($r1);
                        echo '<h4>Edificio: ' . $row['nombre_edificio'] . '</h4>';
                        ?>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertarEquipo">
                            Insertar Nuevo Departamento
                        </button>
                    </div>
                    <div class="col">
                        <h5>Buscar Departamento:</h5>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" id="inputFilter" aria-label="Busqueda por Parametros">
                    </div>
                </div>
            </div>

            <!-- Modal -->
        </div>
        <div class="modal fade" name="insertarEquipo" id="insertarEquipo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertarEquipoLabel">Ingresar Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="prueba.php?p=gestion_departamentos_edificios\gestion_departamentos" method="post">
                        <div class="modal-body">
                            <div class="container-sm">
                                <input type="hidden" name="id_edificio" value=<?php print $_SESSION['id_edificio'] ?>>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre Departamento</span>
                                    <input type="text" aria-label="nombre_departamento" name="nombre_departamento" class="form-control" required>
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
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_departamentos_edificios\gestion_departamentos" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="deleteForm" name="delete_id" id="delete_id">
                            ¿Estás seguro que quieres eliminar el departamento seleccionado?
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
        <div class="modal fade" id="modificarEdificio" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_departamentos_edificios\gestion_departamentos" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="modifyForm" name="modify_id" id="modify_id">
                            <div class="container-sm">
                                <input type="hidden" name="id_edificio" value=<?php print $_SESSION['id_edificio'] ?>>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre Departamento</span>
                                    <input type="text" aria-label="nombre_departamento" name="nombre_departamento" class="form-control" required>
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
                <h4 class="my-4 ">Listado de Departamentos</h4>
            </div>
            <div class="table-responsive caption-top">
                <table class="table" id="infoGestion">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre Departamento</th>
                            <th scope="col">Organización</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT departamentos.* FROM departamentos, edificios, organizaciones WHERE departamentos.id_edificio = edificios.id_edificio 
                        AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION["id_organizacion"] . "
                        AND edificios.id_edificio = " . $_SESSION["id_edificio"] . ";";
                        $resultado = mysqli_query($conexion, $consulta);
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $id_consultado = $row["ID_DEPARTAMENTO"];
                            $nombre_consultado = $row["NOMBRE_DEPARTAMENTO"];
                            echo "<tr>";
                            echo "<td>" . $id_consultado . "</td>";
                            echo  "<td>" . $nombre_consultado . "</td>";
                            $q2 = "SELECT nombre_organizacion FROM organizaciones WHERE id=" . $_SESSION["id_organizacion"] . ";";
                            $r2 = mysqli_query($conexion, $q2);
                            $organizacion = mysqli_fetch_assoc($r2);
                            echo  "<td>" . $organizacion["nombre_organizacion"] . "</td>";
                            echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id_consultado . '" ><span class="material-icons">delete</span></button>  
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modificarEdificio" data-bs-whatever="' . $id_consultado . '"> <span class="material-icons">edit</span> </button>';
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
        var modalModify = document.getElementById('modificarEdificio')
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
        $(document).ready(function () {
            $("#inputFilter").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#infoGestion tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>

</html>