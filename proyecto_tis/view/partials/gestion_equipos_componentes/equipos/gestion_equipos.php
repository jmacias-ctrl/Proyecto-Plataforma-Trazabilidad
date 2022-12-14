<?php
require('conexion.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insertBoton'])) {
        $nombre_equipo = $_POST["nombre_equipo"];
        $rut = $_POST["rut"];
        $fechaAdquisicion = $_POST["fAdquisicion"];
        $costoaAdquisicion = $_POST["cAdquisicion"];
        $caracteristicasAdquisicion = $_POST["tAdquisicion"];
        $formaaAdquisicion = $_POST["foAdquisicion"];
        $id_departamento = $_POST["idDepartamento"];

        $q0 = "SELECT nombre_funcionario FROM funcionarios WHERE rut_funcionario ='" . $rut . "';";
        $r0 = mysqli_query($conexion, $q0);
        if (mysqli_num_rows($r0) > 0) {
            $q1 = "INSERT INTO equipos VALUES (DEFAULT," . $id_departamento . ", " . $rut . ", '" . $nombre_equipo . "', '" . $fechaAdquisicion . "', '" . $costoaAdquisicion . "','" . $caracteristicasAdquisicion . "', '" . $formaaAdquisicion . "', 'Inactivo', 0);";
            $r1 = mysqli_query($conexion, $q1);

            //feedback correo
            $correo = $_SESSION['correo'];

            $header = "From: noreply@example.com" . "\r\n";
            $header .= "Reply-To: noreply@example.com" . "\r\n";
            $header .= "X-Mailer: PHP/" . phpversion();
            
            $mail = mail($correo, "|Control de inventario| Registro de actividad", "Se registro correctamente el equipo ". $id_departamento . ", " . $rut . ", '" . $nombre_equipo ."", $header);
            //feedback correo FIN

        } else {
            echo "Error: Rut del funcionario no esta presente en la base de datos.";
        }
    } else if (isset($_POST['deletedata'])) {
        $id_equipo = $_POST["delete_id"];
        $q2 = "DELETE FROM equipos WHERE id_equipo='" . $id_equipo . "';";
        $r2 = mysqli_query($conexion, $q2);
        //feedback correo
        $correo = $_SESSION['correo'];

        $header = "From: noreply@example.com" . "\r\n";
        $header .= "Reply-To: noreply@example.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        
        $mail = mail($correo, "|Control de inventario| Registro de actividad", "Se borro correctamente el equipo ". $id_equipo, $header);
        //feedback correo FIN
    } else if (isset($_POST['modificarData'])) {
        $nombre_equipo = $_POST["nombre_equipo"];
        $id_equipo = $_POST["modify_id"];
        $rut = $_POST["rut"];
        $fechaAdquisicion = $_POST["fAdquisicion"];
        $costoaAdquisicion = $_POST["cAdquisicion"];
        $caracteristicasAdquisicion = $_POST["tAdquisicion"];
        $formaaAdquisicion = $_POST["foAdquisicion"];
        $id_departamento = $_POST["idDepartamento"];

        $q3 = "UPDATE equipos
        SET id_equipo=" . $id_equipo . ", rut_funcionario=" . $rut . ", nombre_equipo='" . $nombre_equipo . "', fecha_adquisicion='" . $fechaAdquisicion . "', costo_adquisicion=" . $costoaAdquisicion . ",caracteristicas_adquisicion='" . $caracteristicasAdquisicion . "', 
        forma_adquisicion='" . $formaaAdquisicion . "', id_departamento=" . $id_departamento . " WHERE id_equipo=" . $id_equipo . ";";
        $r3 = mysqli_query($conexion, $q3);

        //feedback correo
        $correo = $_SESSION['correo'];

        $header = "From: noreply@example.com" . "\r\n";
        $header .= "Reply-To: noreply@example.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        
        $mail = mail($correo, "|Control de inventario| Registro de actividad", "Se modifico correctamente el equipo ". $id_departamento . ", " . $rut . ", '" . $nombre_equipo ."'", $header);
        //feedback correo FIN

    } else if (isset($_POST["cambioEstado"])) {
        $id_equipo = $_POST["id_cambio"];
        $estado_nuevo = $_POST["estado_nuevo"];
        $q1 = "UPDATE equipos
        SET estado= '" . $estado_nuevo . "' WHERE id_equipo=" . $id_equipo . ";";
        $r1 = mysqli_query($conexion, $q1);

        //feedback correo
        $correo = $_SESSION['correo'];

        $header = "From: noreply@example.com" . "\r\n";
        $header .= "Reply-To: noreply@example.com" . "\r\n";
        $header .= "X-Mailer: PHP/" . phpversion();
        
        $mail = mail($correo, "|Control de inventario| Registro de actividad", "Se cambio el estado correctamente el equipo ". $id_equipo . ", " . $estado_nuevo, $header);
        //feedback correo FIN
    }
}

?>

<head>
    <title>Gesti??n de Equipos</title>
</head>

<body>
    <div class="container-sm align-items-center">
        <h1 class="my-3">Gesti??n de equipos</h1>

        <div class="container-sm d-flex align-items-center border border-primary-2 rounded py-3">
            <div class="container aling-self-center">
                <div class="row row-cols-auto d-flex align-items-center">
                    <div class="col">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#insertarEquipo">
                            Insertar Nuevo Equipo
                        </button>
                    </div>
                    <div class="col">
                        <h5>Buscar Equipo:</h5>
                    </div>
                    <div class="col">
                        <input type="text" id="inputFilter"class="form-control" aria-label="Busqueda por Parametros">
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
                                        Adquisici??n</span>
                                    <input type="date" class="form-control" aria-label="fAdquisicion" name="fAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                               </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Costo de
                                        Adquisici??n</span>
                                    <textarea type="number" class="form-control" aria-label="cAdquisicion" name="cAdquisicion" aria-describedby="inputGroup-sizing-default" required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Caracter??sticas
                                        Adquisici??n</span>
                                    <input type="text" class="form-control" aria-label="tAdquisicion" name="tAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Forma
                                        Adquisici??n</span>
                                    <input type="text" class="form-control" aria-label="foAdquisicion" name="foAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Departamento</span>
                                    <select class="form-select" aria-label="Departamento" name="idDepartamento"
                                        required>
                                        <option selected disabled value="">Seleccione un Departamento</option>
                                        <?php
                                        $q1 = "SELECT * FROM departamentos;";
                                        $r1 = mysqli_query($conexion, $q1);
                                        while ($row = mysqli_fetch_assoc($r1)) {
                                            $id = $row["ID_DEPARTAMENTO"];
                                            $nombre = $row["NOMBRE_DEPARTAMENTO"];
                                            echo '<option value="' . $id . '">' . $nombre . '</option>';
                                        }

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
                            ??Est??s seguro que quieres eliminar el equipo seleccionado?
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
                                    <input type="text" class="nombreEquipo" aria-label="nombre_equipo"
                                        name="nombre_equipo" class="form-control" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Rut Funcionario</span>
                                    <input type="text" class="form-control rutFuncionario" aria-label="rut" name="rut"
                                        aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha
                                        Adquisici??n</span>
                                    <input type="date" class="form-control fAdquisicion" aria-label="fAdquisicion" name="fAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Costo de
                                        Adquisici??n</span>
                                    <textarea type="number" class="form-control cAdquisicion" aria-label="cAdquisicion" name="cAdquisicion" aria-describedby="inputGroup-sizing-default" required></textarea>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text ccAdquisicion" id="inputGroup-sizing-default">Caracter??sticas
                                        Adquisici??n</span>
                                    <input type="text" class="form-control tAdquisicion" aria-label="tAdquisicion" name="tAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Forma
                                        Adquisici??n</span>
                                    <input type="text" class="form-control foAdquisicion" aria-label="foAdquisicion" name="foAdquisicion" aria-describedby="inputGroup-sizing-default" required>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="inputGroup-sizing-default">Departamento</span>
                                    <select class="form-select" aria-label="Departamento" name="idDepartamento"
                                        required>
                                        <option selected disabled value="">Seleccione un Departamento</option>
                                        <?php
                                        $q1 = "SELECT * FROM departamentos;";
                                        $r1 = mysqli_query($conexion, $q1);
                                        while ($row = mysqli_fetch_assoc($r1)) {
                                            $id = $row["ID_DEPARTAMENTO"];
                                            $nombre = $row["NOMBRE_DEPARTAMENTO"];
                                        }
                                        echo '<option value="' . $id . '">' . $nombre . '</option>';
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
        <!-- Modal (QR) -->
        <div class="modal fade" id="generarQR" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">C??digo QR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onClick="delqr()"></button>
                    </div>
                    <div class="modal-body" id='div1'>
                        <div id="qrcode" class="createQrCode" style="width:130px; height:130px; margin-top:15px;"></div><br>
                        <p style="display: inline-block;">Id equipo:</p> <span id="id_display"></span><br>
                        <p style="display: inline-block;">Nombre equipo:</p><span id="nombre_display"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" onclick='download();'>Descargar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onClick="delqr()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="cambiarEstado" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar estado del Equipo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <form action="prueba.php?p=gestion_equipos_componentes\equipos\gestion_equipos" method="post">
                        <div class="modal-body">
                            <input type="hidden" class="cambioEstadoForm" name="id_cambio" id="id_cambio">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default">Seleccione el estado</span>
                                <select class="form-select" name="estado_nuevo" id="estado_nuevo" aria-label="Estados" rquired>
                                    <option selected disabled value="">Elegir Estado...</option>
                                    <option value="Funcionando">Funcionando</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="cambioEstado" id="cambioEstado" class="btn btn-success">Cambiar
                                estado</button>
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
                <table class="table" id="infoGestion">
                    <thead>
                        <tr>
                            <th scope="col">Ver/Cambiar Estado</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Estado</th>
                            <th scope="col mx-auto">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT equipos.* FROM equipos, edificios, departamentos, organizaciones WHERE equipos.id_departamento = departamentos.id_departamento 
                        AND departamentos.id_edificio = edificios.id_edificio AND edificios.id_organizaciones = organizaciones.id AND organizaciones.id = " . $_SESSION['id_organizacion'] . ";";
                        $resultado = mysqli_query($conexion, $query);
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            $id = $row['ID_EQUIPO'];
                            $nombre = $row["NOMBRE_EQUIPO"];
                            $estado = $row["estado"];
                            $rut_funcionario = $row["RUT_FUNCIONARIO"];
                            $fechaAdquisicion = $row["FECHA_ADQUISICION"];
                            $costoAdquisicion = $row["COSTO_ADQUISICION"];
                            $formaAdquisicion = $row["FORMA_ADQUISICION"];
                            $caracteristicasAdquisicion = $row["CARACTERISTICAS_ADQUISICION"];
                            echo '<tr>';
                            echo '<td><a class="btn btn-outline-info" href="prueba.php?p=gestion_equipos_componentes/equipos/reporte_equipo&id=' . $id . '" role="button"><span class="material-symbols-outlined">info</span> </a>
                            <button type="button" id="changeStatus" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#cambiarEstado" data-bs-whatever="' . $id . '"> <span class="material-symbols-outlined">settings</span> </button></td>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $nombre . '</td>';
                            echo '<td>' . $estado . '</td>';
                            echo '<td> <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmacionEliminar" data-bs-whatever="' . $id . '" ><span class="material-icons">delete</span></button>  
                            <button type="button" id="modify" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modificarEquipo" data-bs-whatever="' . $id . '"> <span class="material-icons">edit</span> </button>
                            <a class="btn btn-outline-info" href="prueba.php?p=gestion_equipos_componentes/componentes/gestion_componentes&id=' . $id . '" role="button"> <span class="material-icons"> computer </span> </a>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#generarQR" data-bs-whatever="' . $id . '" onclick= "crearQR(this); rename('.$id.', \''.$nombre.'\')"><span class="material-icons"> qr_code </span></button> </td>';
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
    <script type="text/javascript" src="view/partials/jquery.min.js"></script>
    <script type="text/javascript" src="view/partials/qrcode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" type="text/javascript"></script>
    <script>
        var modalCambioEstado = document.getElementById('cambiarEstado');

        modalCambioEstado.addEventListener('show.bs.modal', function (event) {
            var buttonCambio = event.relatedTarget

            var attributeCambio = buttonCambio.getAttribute('data-bs-whatever')
            var modal_id_cambioestado = modalCambioEstado.querySelector('.cambioEstadoForm')
            modal_id_cambioestado.value = attributeCambio;
        })
    </script>
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
        console.log("modify");
        modalModify.addEventListener('show.bs.modal', function (event) {
            var modifyButton = event.relatedTarget
            console.log("modify");
            // Extract info from data-bs-* attributes
            var attributeModify = modifyButton.getAttribute('data-bs-whatever')
            // Update the modal's content.
            var modalId = modalModify.querySelector('.modifyForm')
            var modalData1 = modalModify.querySelector('.nombreEquipo')
            var modalData2 = modalModify.querySelector('.rutFuncionario')
            var modalData3 = modalModify.querySelector('.fAdquisicion')
            var modalData4 = modalModify.querySelector('.cAdquisicion')
            var modalData5 = modalModify.querySelector('.foAdquisicion')
            var modalData6 = modalModify.querySelector('.tAdquisicion')

            modalId.value = attributeModify;
        })
    </script>
    <script>
        var modalQR = document.getElementById('generarQR')

        function crearQR(event) {
            //var qrButton = event.relatedTarget
            // Extract info from data-bs-* attributes
            var getID = event.getAttribute('data-bs-whatever')
            // Update the modal's content.
            var qrcode = new QRCode(document.getElementById("qrcode"), {
                width: 130,
                height: 130
            });
            qrcode.makeCode("localhost/xampp/Proyecto-Plataforma-Trazabilidad-main/proyecto_tis/view/partials/gestion_equipos_componentes/equipos/reporte_equipo_qr.php?id=" + getID + "");
        }
    </script>

    <script>
        var qr = document.getElementById('qrcode');
        console.log("deleteqr");

        function delqr() {
            qr.innerHTML = '';
            qr.pop();
        }
    </script>
    <script type="text/javascript">
      function download() {
         html2canvas(document.getElementById("div1")).then(function(canvas) {
            document.body.appendChild(canvas);

            const image = canvas.toDataURL("image/png", 1.0);
            const link = document.createElement("a");

            link.download = "my-image.png";
            link.href = image;
            link.click();
            $('canvas').remove();
      });
     }
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
    <script type="text/javascript">
        var id_span = document.getElementById("id_display");
        var nombre_span = document.getElementById("nombre_display");
        function rename(id, nombre) {
            console.log(id);
            console.log(nombre);
            id_span.textContent= id;
            nombre_span.textContent= " "+ nombre;
     }
    </script>
</body>

</html>