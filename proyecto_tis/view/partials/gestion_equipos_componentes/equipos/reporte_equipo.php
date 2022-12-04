<?php

//bd-user-pass-id
require('view\partials\gestion_equipos_componentes\conexion.php');

?>


    <body>
        <br>
        <br>
        <div class="container-xl d-flex flex-column  rounded my-2">
            <div class="align-self-center">
                <h4 class="my-2 ">Reporte del Equipo</h4>
            </div>
            <ul class="list-group">
                <?php
                $id_recibido=$_GET['id'];
                $sql_e="SELECT * FROM equipos WHERE ID_EQUIPO='$id_recibido';";
                $check_e= mysqli_query($conexion, $sql_e);
        
                if(mysqli_num_rows($check_e)!=0){
                    while($row= mysqli_fetch_assoc($check_e)){
                        $id_equipo_consultado= $row["ID_EQUIPO"];
                        $departamento_consultado= $row["ID_DEPARTAMENTO"];
                        $rut_consultado= $row["RUT_FUNCIONARIO"];
                        $nombre_consultado= $row["NOMBRE_EQUIPO"];
                        $fecha_consultada= $row["FECHA_ADQUISICION"];
                        $costo_consultado= $row["COSTO_ADQUISICION"];
                        $caracteristica_consultada= $row["CARACTERISTICAS_ADQUISICION"];
                        $forma_consultada= $row["FORMA_ADQUISICION"];
                        echo '<li class="list-group-item">ID equipo: ' .$id_equipo_consultado.'</li>';
                        echo '<li class="list-group-item">ID departamento: '.$departamento_consultado.'</li>';
                        echo '<li class="list-group-item">RUT del funcionario: '.$rut_consultado.'</li>';
                        echo '<li class="list-group-item">Nombre del equipo: '.$nombre_consultado.'</li>';
                        echo '<li class="list-group-item">Fecha de adquisicion: '.$fecha_consultada.'</li>';
                        echo '<li class="list-group-item">Costo de adquisicion: '.$costo_consultado.'</li>';
                        echo '<li class="list-group-item">Caracteristicas de adquisicion: '.$caracteristica_consultada.'</li>';
                        echo '<li class="list-group-item">Forma de adquisicion: '.$forma_consultada.'</li>';
                    }
                }
                ?>
            </ul>
            <div class="align-self-center">
                <h4 class="my-2 ">Componentes del equipo</h4>
            </div>
            <div class="table-responsive caption-top">
                <table class="table" id="infoComponentes">
                    <thead>
                        <tr>
                            <th scope="col">Id componente</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $consulta= "SELECT * FROM componentes WHERE ID_EQUIPO = '.$id_equipo_consultado.'";
                        $resultado= mysqli_query($conexion, $consulta);
    
                        while($row= mysqli_fetch_assoc($resultado)){
                            $id_consultado= $row["ID_COMPONENTE"];
                            $nombre_consultado= $row["NOMBRE"];
                            $marca_consultada= $row["MARCA"];
                            $modelo_consultado= $row["MODELO"];
                            echo "<tr>";
                            echo "<td>" .$id_consultado. "</td>";
                            echo  "<td>" .$nombre_consultado. "</td>";
                            echo  "<td>" .$marca_consultada. "</td>";
                            echo  "<td>" .$modelo_consultado. "</td>";
                            echo "</tr>";
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>