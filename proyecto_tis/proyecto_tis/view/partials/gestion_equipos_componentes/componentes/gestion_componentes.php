<?php
require('view\partials\gestion_equipos_componentes\conexion.php');
$id_equipo = $_GET['id'];
?>

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
                                <a class="btn btn-borderline-success"
                                    href="prueba.php?p=gestion_equipos_componentes/equipos/gestion_equipos"
                                    role="button"><span class="material-icons">arrow_back</span></a>
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
                                <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#insertarEquipo">
                                    Insertar Nuevo Componente
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
                <div class="modal fade" id="insertarEquipo" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertarEquipoLabel">Ingresar Equipo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes\equipos\post_equipo" method="post">
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Nombre
                                                Componente</span>
                                            <input type="text" class="form-control" aria-label="nComponente"
                                                name="nComponente" aria-describedby="inputGroup-sizing-default"
                                                required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el nombre para el componente.
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Marca</span>
                                            <input type="text" class="form-control" aria-label="mComponente"
                                                name="mComponente" aria-describedby="inputGroup-sizing-default"
                                                required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca la marca del componente
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="inputGroup-sizing-default">Modelo</span>
                                            <input type="text" class="form-control" aria-label="modComponente"
                                                name="modComponente" aria-describedby="inputGroup-sizing-default"
                                                required>
                                            <div class="invalid-feedback">
                                                Por favor introduzca el modelo del componente
                                            </div>
                                        </div>
                                        <select class="form-selec mb-3" required aria-label="Tipo de Componente"
                                            name="selectComponente" id="selectComponente">
                                            <option selected disabled value="">Seleccionar tipo de componente</option>
                                            <option value="form2">Procesador</option>
                                            <option value="form3">Placa Base</option>
                                            <option value="form4">Memorias RAM</option>
                                            <option value="form5">Disco Interno</option>
                                            <option value="none">Otro</option>
                                        </select>
                                        <button type="button" onClick="GFG_Fun()" class="btn btn-dark">Siguiente</button>
                                        <p id="GFG_DOWN"></p>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                            </div>
                            <form action="prueba.php?p=gestion_equipos_componentes/componentes/post_delete_componente"
                                method="POST">
                                <div class="modal-body">
                                    <input type="hidden" class="deleteForm" name="delete_id" id="delete_id">
                                    ¿Estas seguro que quieres eliminar el componente seleccionado?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>
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
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
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
                                    echo '<td>' . $id . '</td>';
                                    echo '<td>' . $nombre . '</td>';
                                    echo '<td>' . $marca . '</td>';
                                    echo '<td>' . $modelo . '</td>';
                                    echo '<td> <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" >Eliminar</button> </td>';
                                    echo '<td> <button type="button" class="btn btn-primary">Modificar</button> </td>';
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
                var modal = document.getElementById('confirmacionEliminar')
                modal.addEventListener('show.bs.modal', function (event) {
                    // Button that triggered the modal
                    var button = event.relatedTarget
                    // Extract info from data-bs-* attributes
                    var recipient = button.getAttribute('data-bs-whatever')
                    // Update the modal's content.
                    var modalId = modal.querySelector('.deleteForm')
                    modalId.value = recipient;
                })
            </script>

            <script>
                var clickedButton = document.getElementById("GFG_DOWN");
                var getTypeComponent = document.getElementById("selectComponente").getAttribute("value");
                function GFG_Fun() {
                    switch (getTypeComponent) {
                        case 'form2':
                            var ID = document.createElement("input");
                            ID.setAttribute("type", "text");
                            ID.setAttribute("name", "");
                            ID.setAttribute("placeholder", "E-Mail ID");
                            break;
                        case 'form3':
                            break;
                        case 'form4':
                            break;
                        case 'form5':
                            break;
                        case 'none':
                    }

                }
            </script>
</body>

</html>