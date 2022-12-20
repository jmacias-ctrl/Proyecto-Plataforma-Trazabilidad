<?php
require('conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insertBoton'])) {
        $nombre_recibido = $_POST["nombre_funcionario"];
        $rut_recibido = $_POST["rut_funcionario"];
        $tipo = $_POST["tipo"];
        $sql = "INSERT INTO funcionarios VALUES(" . $rut_recibido . ",'" . $nombre_recibido . "', '" . $tipo . "')";
        $resultado = mysqli_query($conexion, $sql);
    } else if (isset($_POST['deletedata'])) {
        $rut = $_POST['delete_id'];

        $sql = "DELETE FROM funcionarios WHERE rut_funcionario='$rut'";
        $resultado = mysqli_query($conexion, $sql);
    } else if (isset($_POST['modificarData'])) {
        $rutConsultado = $_POST["modify_id"];
        $rutModificado = $_POST["rut_funcionario"];
        $tipo = $_POST["tipo"];
        $nombre = $_POST["nombre_funcionario"];
        $sql = "UPDATE funcionarios SET nombre_funcionario ='" . $nombre . "', rut_funcionario=" . $rutModificado . ", tipo='" . $tipo . "' WHERE rut_funcionario=" . $rutConsultado . ";";
        $resultado = mysqli_query($conexion, $sql);
    }
}

?>
<title>Reporte de Componentes</title>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gestión de Funcionarios</h1>
        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">

                <div class="row row-cols-auto d-flex align-items-center">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertarFuncionario">
                            Insertar Nuevo Funcionario
                        </button>
                    </div>
                    <div class="col">
                        <h5>Buscar Funcionario:</h5>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" aria-label="Busqueda por Parametros">
                    </div>
                </div>
            </div>

            <!-- Modal -->
        </div>
        <div class="modal fade" name="insertarFuncionario" id="insertarFuncionario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="insertarFuncionarioLabel">Ingresar Funcionario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="prueba.php?p=gestion_funcionarios\gestion_funcionarios" method="post">
                        <div class="modal-body">
                            <div class="container-sm">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Nombre del Funcionario</span>
                                    <input type="text" aria-label="nombre_funcionario" name="nombre_funcionario" class="form-control" required> 
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rut del Funcionario</span>
                                    <input type="text" aria-label="rut_funcionario" name="rut_funcionario" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Tipo de Funcionario</span>
                                    <input type="text" aria-label="tipo" name="tipo" class="form-control" required>
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
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Funcionario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_funcionarios\gestion_funcionarios" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="deleteForm" name="delete_id" id="delete_id">
                            ¿Estás seguro que quieres eliminar el funcionario seleccionado?
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
        <div class="modal fade" id="modificarFuncionario" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Funcionario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_funcionarios\gestion_funcionarios" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="modifyForm" name="modify_id" id="modify_id">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Nombre del Funcionario</span>
                                <input type="text" aria-label="nombre_funcionario" name="nombre_funcionario" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rut del Funcionario</span>
                                <input type="text" aria-label="rut_funcionario" name="rut_funcionario" class="form-control" required>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Tipo de Funcionario</span>
                                <input type="text" aria-label="tipo" name="tipo" class="form-control" required>
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
                <h4 class="my-4 ">Listado de Funcionarios</h4>
            </div>
            <div class="table-responsive caption-top overflow-auto">
                <table class="table" id="infoEquipo">
                    <thead>
                        <tr>
                            <th scope="col">Rut</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta = "SELECT * FROM funcionarios;";
                        $resultado = mysqli_query($conexion, $consulta);
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $rut = $row["RUT_FUNCIONARIO"];
                            $nombre = $row["NOMBRE_FUNCIONARIO"];
                            $tipo = $row["TIPO"];
                            echo "<tr>";
                            echo "<td>" . $rut . "</td>";
                            echo  "<td>" . $nombre . "</td>";
                            echo  "<td>" . $tipo . "</td>";
                            echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $rut . '" ><span class="material-icons">delete</span></button>  
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modificarFuncionario" data-bs-whatever="' . $rut . '"> <span class="material-icons">edit</span> </button>';
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
        var modalModify = document.getElementById('modificarFuncionario')
        modalModify.addEventListener('show.bs.modal', function(event) {
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